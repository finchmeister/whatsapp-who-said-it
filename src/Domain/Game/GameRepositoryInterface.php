<?php

namespace App\Domain\Game;

use App\Domain\Chat\WhatsAppChat;
use App\Domain\Player\Player;
use App\Game\Game;

interface GameRepositoryInterface
{
    public function findByPlayerAndChat(Player $player, WhatsAppChat $chat): ?Game;

    public function saveGame(Game $game): void;
}
