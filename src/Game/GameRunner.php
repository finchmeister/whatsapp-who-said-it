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

    public function loadGame(GameConfigInterface $gameContext)
    {
        if ($game = $this->context->loadGame($gameContext)) {
            return $game;
        }

        $game = $this->context->newGame($gameContext);
        $this->context->save($game);

        return $game;
    }


}