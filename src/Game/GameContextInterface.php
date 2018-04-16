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
     * @param GameContextInterface $context
     * @return Game
     */
    public function newGame(GameContextInterface $context): Game;

    /**
     * Loads an existing game.
     *
     * @return Game
     */
    public function loadGame(): Game;

    /**
     * Saves the provided game.
     *
     * @param Game $game The game to save
     * @return void
     */
    public function save(Game $game): void;
}
