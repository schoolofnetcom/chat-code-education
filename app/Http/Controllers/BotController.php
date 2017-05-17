<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\Bot\Webhook;
use Bot\Message\Text;
use Bot\CallSendAPI;

class BotController extends Controller
{
    public function subscribe(Request $request)
    {
        $hub_challenge = Webhook::check(config('botfb.validationToken'));
        if (!$hub_challenge) {
            abort(403, 'Unauthorized action');
        }
        return $hub_challenge;
    }

    public function receiveMessage(Request $request)
    {
        $event = file_get_contents("php://input");
        $event = json_decode($event, true, 512, JSON_BIGINT_AS_STRING);
        $event = $event['entry'][0]['messaging'][0];

        $senderId = $event['sender']['id'];
        //$message = $event['message']['text'];
        $postback = $event['postback'];

        $text = new Text($senderId);
        $callSendApi = new CallSendAPI(config('botfb.pageAccessToken'));

        switch ($postback['payload']) {
            case 'inicio':
                $message = $text->message('Oiii!!!!');
                $callSendApi->make($message);

                $message = $text->message('Eu sou o BotCode e fui criado na série de videos sobre bots da Code.Education');
                $callSendApi->make($message);
                break;
        }

        return response()->json(['status'=>'success']);
    }
}
