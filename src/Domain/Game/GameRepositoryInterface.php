<?php

namespace App\Domain\Game;

use App\Domain\Game\Game;

interface GameRepositoryInterface
{
    public function get(GameId $gameId): ?Game;

    public function getNextGameId(): GameId;

    public function save(Game $game): void;
}
