<?php


namespace App\Game;

/**
 * Class GameContextDoctrine
 * @package App\Game
 */
class GameContextDoctrine implements GameContextInterface
{
    public function reset(): void
    {
        // TODO: Implement reset() method.
    }

    public function newGame(GameConfigInterface $context): Game
    {
        // TODO: Implement newGame() method.
    }

    public function loadGame(GameConfigInterface $context): ?Game
    {
        // TODO: Implement loadGame() method.
    }

    public function save(Game $game): void
    {
        // TODO: Implement save() method.
    }

}