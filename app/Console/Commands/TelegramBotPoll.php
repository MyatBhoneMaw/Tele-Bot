<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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

                // Handle /start
                if (isset($update['message']['text'])) {
                    $chatId = $update['message']['chat']['id'];
                    $text = $update['message']['text'];

                    if ($text === '/start' || $update['message']['text']) {
                        $keyboard = Keyboard::make()
                            ->inline()
                            ->row([Keyboard::inlineButton(['text' => 'ကဗျာတွေ', 'callback_data' => 'option_a']), Keyboard::inlineButton(['text' => 'စာအုပ်တွေ', 'callback_data' => 'option_b'])]);

                        $telegram->sendMessage([
                            'chat_id' => $chatId,
                            'text' => 'မိတ်ဆွေ ကဗျာတွေ ဖတ်မှာလား ဒါမှမဟုတ် စာအုပ်တွေ ဖတ်မှာလား',
                            'reply_markup' => $keyboard,
                        ]);
                    }
                }

                // Handle Callback Query
                if (isset($update['callback_query'])) {
                    $chatId = $update['callback_query']['message']['chat']['id'];
                    $data = $update['callback_query']['data'];

                    $responseText = match ($data) {
                        'option_a' => 't.me/gabyargallery',
                        'option_b' => 't.me/mmliteratureadmin',
                        default => 'တစ်ခုကို ရွေးချယ်ပါ',
                    };

                    // First message: plan confirmation
                    $telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => $responseText,
                    ]);

                    // Second message: confirm payment
                    // $telegram->sendMessage([
                    //     'chat_id' => $chatId,
                    //     'text' => 'Payment အတည်ပြုပါ',
                    // ]);
                }
            }

            sleep(1);
        }
    }


    // public function handle()
    // {
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








// Handle Callback Query
// if (isset($update['callback_query'])) {
//     $chatId = $update['callback_query']['message']['chat']['id'];
//     $data = $update['callback_query']['data'];

//     $responseText = match ($data) {
//         'option_a' => 'သင် 15K plan ကို ရွေးချယ်ခဲ့ပါသည်။',
//         'option_b' => 'သင် 25K plan ကို ရွေးချယ်ခဲ့ပါသည်။',
//         default => 'Unknown choice',
//     };

//     $telegram->sendMessage([
//         'chat_id' => $chatId,
//         'text' => $responseText,
//     ]);
// }
// if (isset($update['callback_query'])) {
//     $chatId = $update['callback_query']['message']['chat']['id'];
//     $data = $update['callback_query']['data'];

//     // $responseText = match ($data) {
//     //     'option_a' => 'သင် 15K plan ကို ရွေးချယ်ခဲ့ပါသည်။',
//     //     'option_b' => 'သင် 25K plan ကို ရွေးချယ်ခဲ့ပါသည်။',
//     //     default => 'Unknown choice',
//     // };

//     $telegram->sendMessage([
//         'chat_id' => $chatId,
//         'text' => 'Payment အတည်ပြုပါ',
//     ]);
// }
