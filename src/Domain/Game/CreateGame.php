<?php


namespace App\Domain\Game;


use App\Domain\Chat\Chat;
use App\Domain\Player\Player;
use App\Game\Game;

class CreateGame
{
    public function createNewGame(
        Player $player,
        Chat $chat
    ): Game {

    }

    private function getWhatsAppChat()
    {

    }
}