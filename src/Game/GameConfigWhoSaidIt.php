<?php


namespace App\Game;


class GameConfigWhoSaidIt implements GameConfigInterface
{
    public const WHO_SAID_IT = 'who_said_it';

    public function getId()
    {
        // TODO: Implement getId() method.
    }


    public function getUser()
    {
        // TODO: Implement getUser() method.
    }


    public function getChat()
    {
        return '';
        // TODO: Implement getChat() method.
    }

    public function getGameMode(): string
    {
        return self::WHO_SAID_IT;
    }

}