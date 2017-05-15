<?php

namespace Bot;

class Webhook
{
    public function check(string $token)
    {
        $hubMode = filter_input(INPUT_GET, 'hub_mode');
        $hubVerifyToken = filter_input(INPUT_GET, 'hub_verify_token');
        if ($hubMode === 'subscribe' and $hubVerifyToken === $token) {
            return filter_input(INPUT_GET, 'hub_challenge');
        }
        return false;
    }
}