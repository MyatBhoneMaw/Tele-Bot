<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ramsey\Uuid\Type\Integer;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;

class TelegramBotPoll extends Command
{
    protected $signature = 'telegram:poll';
    protected $description = 'Run Telegram Bot with Long Polling';

    public function handle()
    {
        $telegram = new Api();
        $offset = 0;

        $this->info('Bot polling started...');

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

                    if ($text === '/start') {
                        $this->handleStart($chatId, $telegram);
                    } elseif (ctype_digit($text)) {
                        $telegram->sendMessage([
                            'chat_id' => $chatId,
                            'text' => 'မိတ်ဆွေ ဖုန်းနံပါတ်အား စစ်ဆေးနေပါသည်.....',
                        ]);
                        sleep(2);

                        if (preg_match('/^(097|၀၉၇)\d{8}$/u', $text)) {
                            $keyboard = Keyboard::make()
                                ->inline()
                                ->row([Keyboard::inlineButton(['text' => '15K Plan', 'callback_data' => '15K Plan']), Keyboard::inlineButton(['text' => '25K Plan', 'callback_data' => '25K Plan'])]);

                            $telegram->sendMessage([
                                'chat_id' => $chatId,
                                'text' => 'မိတ်ဆွေအသုံးပြုလိုသော package ကို ရွေးပါ။',
                                'reply_markup' => $keyboard,
                            ]);
                        } else {
                            $telegram->sendMessage([
                                'chat_id' => $chatId,
                                'text' => 'မိတ်ဆွေဖုန်းနံပါတ်သည် ATOM ဖုန်းနံပါတ်မဟုတ်ပါ။ ဥပမာ - 097##########',
                            ]);
                        }
                    } else {
                        $telegram->sendMessage([
                            'chat_id' => $chatId,
                            'text' => 'မိတ်ဆွေ၏ ATOM ဖုန်းနံပါတ်အား Package ဝယ်ယူရန်အတွက် ပို့ပါ။',
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
            'text' => 'မိတ်ဆွေဖုန်းအတွက် 15K Plan သို့မဟုတ် 25K Plan ဝယ်ယူအသုံးပြုလိုပါလား။ အသုံးပြုလိုပါက မိတ်ဆွေရဲ့ ATOM ဖုန်းနံပါတ် (ဥပမာ - 097##########) ကို ပေးပို့ပါ။',
        ]);
    }

    private function handleCallbackQuery($update, $telegram)
    {
        $chatId = $update['callback_query']['message']['chat']['id'];
        $data = $update['callback_query']['data'];

        $this->info('User selected: ' . $data);

        $responseText = match ($data) {
            '15K Plan' => 'မိတ်ဆွေ 15K Plan ကို ရွေးချယ်ခဲ့ပါသည်။',
            '25K Plan' => 'မိတ်ဆွေ 25K Plan ကို ရွေးချယ်ခဲ့ပါသည်။',
            default => 'တစ်ခုကို ရွေးချယ်ပါ။',
        };

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $responseText,
        ]);

        sleep(1);

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => 'ငွေပေးချေမှု အတည်ပြုပါ။',
        ]);
    }

    // private function sendInvalidPrompt($chatId, $telegram)
    // {
    //     $telegram->sendMessage([
    //         'chat_id' => $chatId,
    //         'text' => 'ကျေးဇူးပြု၍ ATOM ဖုန်းနံပါတ် (097##########) ကိုသာ ထည့်ပါ။',
    //     ]);
    // }

    //  private function isValidPhoneNumber($text): bool
    // {
    //     if (!ctype_digit($text)) {
    //         return false;
    //     }

    //     return preg_match('/^(097|၀၉၇)\d{8}$/u', $text);
    // }

    // private function handlePhoneNumber($text, $chatId, $telegram)
    // {
    //     $telegram->sendMessage([
    //         'chat_id' => $chatId,
    //         'text' => 'သင့်ဖုန်းနံပါတ်အား စစ်ဆေးနေပါသည်...',
    //     ]);

    //     sleep(1);

    //     if (!preg_match('/^(097|၀၉၇)\d{8}$/u', $text)) {
    //         $telegram->sendMessage([
    //             'chat_id' => $chatId,
    //             'text' => 'မိတ်ဆွေဖုန်းနံပါတ်သည် ATOM ဖုန်းနံပါတ်မဟုတ်ပါ။ ဥပမာ - 097##########',
    //         ]);
    //         return;
    //     }

    //     if (strlen($text) !== 11) {
    //         $telegram->sendMessage([
    //             'chat_id' => $chatId,
    //             'text' => 'ဖုန်းနံပါတ်သည် 11 လုံး (09 အပါအဝင်) ဖြစ်ရပါမည်။',
    //         ]);
    //         return;
    //     }

    //     // info('Valid phone: ' . $text);

    //     $keyboard = Keyboard::make()
    //         ->inline()
    //         ->row([Keyboard::inlineButton(['text' => '15K Plan', 'callback_data' => '15K Plan']), Keyboard::inlineButton(['text' => '25K Plan', 'callback_data' => '25K Plan'])]);

    //     $telegram->sendMessage([
    //         'chat_id' => $chatId,
    //         'text' => 'မိတ်ဆွေအသုံးပြုလိုသော package ကို ရွေးပါ။',
    //         'reply_markup' => $keyboard,
    //     ]);
    // }
}
