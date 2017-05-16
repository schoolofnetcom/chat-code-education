<?php

namespace Bot;

use GuzzleHttp\Client;

class CallSendAPI
{
    const URL = 'https://graph.facebook.com/v2.6/me/messages';
    private $pageAccessToken;

    public function __construct(string $pageAccessToken)
    {
        $this->pageAccessToken = $pageAccessToken;
    }

    public function make(array $message) :string
    {
        $client = new Client;

        $response = $client->request('POST', CallSendAPI::URL, [
            'json'=> $message,
            'query'=>['access_token'=> $this->pageAccessToken]
        ]);

        return (string)$response->getBody();
    }
}