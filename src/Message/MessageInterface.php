<?php

namespace Bot\Message;

interface MessageInterface
{
    public function __construct(string $recipientId);
    public function message(string $messageText) :array;
}