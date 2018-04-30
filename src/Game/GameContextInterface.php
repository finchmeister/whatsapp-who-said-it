<?php

namespace App\Game;

/**
 * Interface GameContextInterface
 * @package App\Game
 */
interface GameContextInterface
{
    /**
     * Resets the current game context
     *
     * @return void
     */
    public function reset(): void;

    /**
     * @param GameConfigInterface $context
     * @return Game
     */
    public function newGame(GameConfigInterface $context): Game;

    /**
     * @param GameConfigInterface $context
     * @return Game|null
     */
    public function loadGame(GameConfigInterface $context): ?Game;

    /**
     * Saves the provided game.
     *
     * @param Game $game The game to save
     * @return void
     */
    public function save(Game $game): void;
}
