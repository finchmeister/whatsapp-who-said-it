<?php


namespace App\Domain\Game;


use App\Domain\Chat\WhatsAppChat;
use App\Domain\Player\Player;
use App\Game\Game;

class CreateGame
{
    public function createNewGame(
        Player $player,
        WhatsAppChat $chat
    ): Game {

    }

    private function getWhatsAppChat()
    {

    }
}