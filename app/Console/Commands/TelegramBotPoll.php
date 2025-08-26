<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Purchase;
use Illuminate\Console\Command;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;

class TelegramBotPoll extends Command
{
    protected $signature = 'telegram:poll';
    protected $description = 'Run Telegram Bot with Long Polling';

    protected $tempPhones = [];

    public function handle()
    {
        $telegram = new Api();
        $offset = 0;

        $this->info('🤖 Bot polling started...');

        while (true) {
            $updates = $telegram->getUpdates([
                'offset' => $offset + 1,
                'timeout' => 10,
            ]);

            foreach ($updates as $update) {
                $offset = $update->getUpdateId();

                if (isset($update['message']['text'])) {
                    $chatId = $update['message']['chat']['id'];
                    $text = $update['message']['text'];
                    $username = $update['message']['chat']['username'] ?? null;

                    if ($text === '/start') {
                        $this->handleStart($chatId, $telegram);
                    } elseif (preg_match('/^(097|၀၉၇)\d{8}$/u', $text)) {
                        // Save user (if not exists)
                        User::updateOrCreate(
                            ['chat_id' => $chatId],
                            ['user_name' => $username]
                        );

                        // Temporarily store phone number
                        $this->tempPhones[$chatId] = $text;

                        // Ask for plan selection
                        $keyboard = Keyboard::make()
                            ->inline()
                            ->row([
                                Keyboard::inlineButton(['text' => '15K Plan', 'callback_data' => '15K Plan']),
                                Keyboard::inlineButton(['text' => '25K Plan', 'callback_data' => '25K Plan']),
                            ]);

                        $telegram->sendMessage([
                            'chat_id' => $chatId,
                            'text' => '📦 မိတ်ဆွေ အသုံးပြုလိုသော package ကို ရွေးပါ။',
                            'reply_markup' => $keyboard,
                        ]);
                    } elseif (ctype_digit($text)) {
                        $telegram->sendMessage([
                            'chat_id' => $chatId,
                            'text' => '❌ ဖုန်းနံပါတ်သည် ATOM format မဟုတ်ပါ။ ဥပမာ - 097XXXXXXXX',
                        ]);
                    } else {
                        $telegram->sendMessage([
                            'chat_id' => $chatId,
                            'text' => '📱 မိတ်ဆွေရဲ့ ATOM ဖုန်းနံပါတ် (ဥပမာ - 097XXXXXXXX) ကို ပေးပို့ပါ။',
                        ]);
                    }
                }

                if (isset($update['callback_query'])) {
                    $this->handleCallbackQuery($update, $telegram);
                }
            }

            sleep(1);
        }
    }

    private function handleStart($chatId, $telegram)
    {
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "မင်္ဂလာပါ။\n\n📱 မိတ်ဆွေရဲ့ ATOM ဖုန်းနံပါတ် (ဥပမာ - 097XXXXXXXX) ကို ပေးပို့ပါ။",
        ]);
    }

    private function handleCallbackQuery($update, $telegram)
    {
        $chatId = $update['callback_query']['message']['chat']['id'];
        $data = $update['callback_query']['data'];

        $phone = $this->tempPhones[$chatId] ?? null;

        if (!$phone) {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => '❗ ပထမဦးဆုံး ဖုန်းနံပါတ်ပေးရန် လိုအပ်သည်။',
            ]);
            return;
        }

        Purchase::create([
            'chat_id' => $chatId,
            'user_phone' => $phone,
            'selected_plan' => $data,
            'payment_status' => 'pending'
        ]);

        $responseText = match ($data) {
            '15K Plan' => '✅ မိတ်ဆွေ 15K Plan ကို ရွေးချယ်ခဲ့ပါသည်။',
            '25K Plan' => '✅ မိတ်ဆွေ 25K Plan ကို ရွေးချယ်ခဲ့ပါသည်။',
            default => '❌ မမှန်သော Plan တစ်ခု ရွေးချယ်ထားသည်။',
        };

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $responseText,
        ]);

        sleep(1);

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => '💳 ငွေပေးချေမှုအတွက် ဆက်လက်လုပ်ဆောင်ပါ။',
        ]);

        $this->info("💾 New purchase saved for chat_id $chatId with plan $data");
    }
}
