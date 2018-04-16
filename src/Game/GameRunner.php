<?php


namespace App\Game;

class GameRunner
{
    /** @var GameContextInterface  */
    protected $context;

    public function __construct(
        GameContextInterface $context
    ) {
        $this->context = $context;
    }

    public function loadGame()
    {
        if ($game = $this->context->loadGame()) {
            return $game;
        }

        $game = $this->context->newGame();
        $this->context->save($game);

        return $game;
    }


}