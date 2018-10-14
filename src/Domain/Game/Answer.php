<?php

namespace App\Domain\Game;

use App\Domain\Player\Player;

class Answer
{
    /** @var Question */
    private $question;
    /** @var Player */
    private $answer;
    /** @var Game */
    private $game;

    public function __construct(
        Question $question,
        Answer $answer,
        Game $game
    ) {
        $this->question = $question;
        $this->answer = $answer;
        $this->game = $game;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }

    public function getAnswer(): Player
    {
        return $this->answer;
    }

    public function getGame(): Game
    {
        return $this->game;
    }
}
