<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;

class TelegramBotPoll extends Command
{
    protected $signature = 'telegram:poll';
    protected $description = 'Run Telegram Bot with Long Polling';


    /**
     * for poem & book
     */
    // public function handle(){
    //     $telegram = new Api();

    //     $offset = 0;

    //     $this->info('Bot polling started...');

    //     while (true) {
    //         $updates = $telegram->getUpdates([
    //             'offset' => $offset + 1,
    //             'timeout' => 10,
    //         ]);

    //         foreach ($updates as $update) {
    //             $offset = $update->getUpdateId();

    //             // Handle /start
    //             if (isset($update['message']['text'])) {
    //                 $chatId = $update['message']['chat']['id'];
    //                 $text = $update['message']['text'];

    //                 if ($text === '/start' || $update['message']['text']) {
    //                     $keyboard = Keyboard::make()
    //                         ->inline()
    //                         ->row([Keyboard::inlineButton(['text' => 'ကဗျာတွေ', 'callback_data' => 'option_a']), Keyboard::inlineButton(['text' => 'စာအုပ်တွေ', 'callback_data' => 'option_b'])]);

    //                     $telegram->sendMessage([
    //                         'chat_id' => $chatId,
    //                         'text' => 'မိတ်ဆွေ ကဗျာတွေ ဖတ်မှာလား ဒါမှမဟုတ် စာအုပ်တွေ ဖတ်မှာလား',
    //                         'reply_markup' => $keyboard,
    //                     ]);
    //                 }
    //             }

    //             // Handle Callback Query
    //             if (isset($update['callback_query'])) {
    //                 $chatId = $update['callback_query']['message']['chat']['id'];
    //                 $data = $update['callback_query']['data'];

    //                 $responseText = match ($data) {
    //                     'option_a' => 't.me/gabyargallery',
    //                     'option_b' => 't.me/mmliteratureadmin',
    //                     default => 'တစ်ခုကို ရွေးချယ်ပါ',
    //                 };

    //                 // First message: plan confirmation
    //                 $telegram->sendMessage([
    //                     'chat_id' => $chatId,
    //                     'text' => $responseText,
    //                 ]);

    //                 // Second message: confirm payment
    //                 // $telegram->sendMessage([
    //                 //     'chat_id' => $chatId,
    //                 //     'text' => 'Payment အတည်ပြုပါ',
    //                 // ]);
    //             }
    //         }

    //         sleep(1);
    //     }
    // }


    /**
     * for project
     */
     public function handle(){
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

                // Handle /start
                if (isset($update['message']['text'])) {
                    $chatId = $update['message']['chat']['id'];
                    $text = $update['message']['text'];

                    if ($text === '/start' || $update['message']['text']) {
                        $keyboard = Keyboard::make()
                            ->inline()
                            ->row([Keyboard::inlineButton(['text' => '15K Plan', 'callback_data' => 'option_a']), Keyboard::inlineButton(['text' => '25K Plan', 'callback_data' => 'option_b'])]);

                        $telegram->sendMessage([
                            'chat_id' => $chatId,
                            'text' => 'မိတ်ဆွေအသုံးပြုလိုသော package ကို ရွေးပါ',
                            'reply_markup' => $keyboard,
                        ]);
                    }
                }

                // Handle Callback Query
                if (isset($update['callback_query'])) {
                    $chatId = $update['callback_query']['message']['chat']['id'];
                    $data = $update['callback_query']['data'];

                    $responseText = match ($data) {
                        'option_a' => 'မိတ်ဆွေ 15K Plan ကိုရွေးချယ်ခဲ့ပါသည်။',
                        'option_b' => 'မိတ်ဆွေ 25K Plan ကိုရွေးချယ်ခဲ့ပါသည်။',
                        default => 'တစ်ခုကို ရွေးချယ်ပါ',
                    };

                    // First message: plan confirmation
                    $telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => $responseText,
                    ]);

                    // Second message: confirm payment
                    $telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Payment အတည်ပြုပါ',
                    ]);
                }

                if(isset($update['message']['text'])){
                    $chatId = $update['message']['chat']['id'];
                    $telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'သင်ရွေးချယ်ထားသော Plan Package အားဖြည့်ပေးထားပါပြီ။သင့်ဖုန်းတွင် စစ်ဆေးပါ။မရောက်သေးပါက ၁ နာရီ အတွင်း အကြောင်းကြားရန် - 0978654321 အားဆက်သွယ်ပါ။'
                    ]);
                }
            }

            sleep(1);
        }
    }

    /**
     * စုစု
     */
    // public function handle(){
    //     $telegram = new Api();

    //     $offset = 0;

    //     $this->info('Bot polling started...');

    //     while (true) {
    //         $updates = $telegram->getUpdates([
    //             'offset' => $offset + 1,
    //             'timeout' => 10,
    //         ]);

    //         foreach ($updates as $update) {
    //             $offset = $update->getUpdateId();

    //             // Handle /start
    //             if (isset($update['message']['text'])) {
    //                 $chatId = $update['message']['chat']['id'];
    //                 $text = $update['message']['text'];

    //                 if ($text === '/start' || $update['message']['text']) {
    //                     $keyboard = Keyboard::make()
    //                         ->inline()
    //                         ->row([Keyboard::inlineButton(['text' => 'ဘူးဘူးကို စားမယ်', 'callback_data' => 'option_a']), Keyboard::inlineButton(['text' => 'မော်ကြီးကို စားမယ်', 'callback_data' => 'option_b'])]);

    //                     $telegram->sendMessage([
    //                         'chat_id' => $chatId,
    //                         'text' => 'စုစု တစ်ခုတော့ရွေး',
    //                         'reply_markup' => $keyboard,
    //                     ]);
    //                 }
    //             }

    //             // Handle Callback Query
    //             if (isset($update['callback_query'])) {
    //                 $chatId = $update['callback_query']['message']['chat']['id'];
    //                 $data = $update['callback_query']['data'];

    //                 $responseText = match ($data) {
    //                     'option_a' => 'ဘူးဘူး ကို စားမှာပေါ့ ဟဲဟဲ ဘူးဘူးကလဲစားချင်နေတာ စုစုကို',
    //                     'option_b' => 'မော်ကြီးကို စားမှာပေါ့ ဟဲဟဲ မော်ကြီးကလဲစားချင်နေတာ စုစုကို',
    //                     default => 'ညိ ချီးစားလိုက်',
    //                 };

    //                 // First message: plan confirmation
    //                 $telegram->sendMessage([
    //                     'chat_id' => $chatId,

    //                     'text' => $responseText,
    //                 ]);

    //                 // Second message: confirm payment
    //                 // $telegram->sendMessage([
    //                 //     'chat_id' => $chatId,
    //                 //     'text' => 'ညိ ချီးစားလိုက်',
    //                 // ]);
    //             }
    //         }

    //         sleep(1);
    //     }
    // }
}










