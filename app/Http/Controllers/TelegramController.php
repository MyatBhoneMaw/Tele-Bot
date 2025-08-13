<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function sendMessage()
    {
        $updates = Telegram::getUpdates();
        // dd($updates);
        if (empty($updates)) {
            return 'No messages found.';
        }
        $lastUpdate = end($updates);

        if (!isset($lastUpdate['message'])) {
            return 'No message found in the update.';
        }

        $chatId = $lastUpdate['message']['chat']['id'];
        $userMessage = $lastUpdate['message']['text'] ?? '(no text)';
        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => 'ယောက်ဖ တစ်ခုတော့ရွေးကွာ မင်းကလဲ',
            'reply_markup' => json_encode([
                'keyboard' => [[['text' => 'ဖိုးသာထူး'], ['text' => 'မင်းတို့က']]],
                'resize_keyboard' => true,
                'one_time_keyboard' => true,
            ]),
        ]);
        return $lastUpdate;
    }

    public function checkReply()
    {
        $updates = Telegram::getUpdates();
        // dd($updates);
        if (empty($updates)) {
            return 'No messages found.';
        }

        $lastUpdate = end($updates);

        if (!isset($lastUpdate['message'])) {
            return 'No message found in the update.';
        }

        $chatId = $lastUpdate['message']['chat']['id'];
        $userText = $lastUpdate['message']['text'] ?? '';

        if ($userText === 'ဖိုးသာထူး') {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'ဖိုးသာထူး ဖိုးသာထူး KMKL ဖိုသာထူး',//သင် 15K Plan ကို ရွေးခဲ့ပါတယ်။Payment အတည်ပြုပါ။
            ]);
        } elseif ($userText === 'မင်းတို့က') {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'မင်းတို့က မဟုတ်တော့ဘူးကွ သုံးယောက်တစ်ယောက်ကို',//သင် 20K Plan ကို ရွေးခဲ့ပါတယ်။Payment အတည်ပြုပါ။
            ]);
        } else {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'သင် ရွေးချယ်ထားတဲ့ message ကို မသိပါ။',
            ]);
        }

        return 'Checked user reply.';
    }
}

