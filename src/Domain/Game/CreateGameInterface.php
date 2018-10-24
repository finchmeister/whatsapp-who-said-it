<?php


namespace App\Domain\Game;


use App\Domain\Chat\Chat;
use App\Domain\Player\Player;
use App\Game\Game;

interface CreateGameInterface
{
    public function createNewGame(Player $player, Chat $chat): Game;
}