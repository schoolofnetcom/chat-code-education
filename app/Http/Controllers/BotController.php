<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\Bot\Webhook;

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
}
