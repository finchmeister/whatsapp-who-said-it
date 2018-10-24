<?php

namespace App\Domain\Chat;

class WhatsAppChatFactory
{
    public static function createFromParsedChat(
        string $name,
        array $parsedChat
    ): Chat {
        $messages = [];

        foreach ($parsedChat[1] as $i => $timestamp) {
            $message = new WhatsAppChatMessage();
            $message
                ->setTimestamp(new \DateTime($timestamp))
                ->setUserName($parsedChat[2][$i])
                ->setMessage($parsedChat[3][$i])
            ;
            $messages[] = $message;
        }

        return new Chat($name, $messages);
    }
}
