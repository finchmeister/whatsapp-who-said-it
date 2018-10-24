<?php

namespace App\Domain\Game;

use App\Domain\Chat\Chat;
use App\Domain\Player\Player;
use Assert\Assertion;

class Game
{
    /** @var GameId */
    private $id;
    /** @var Question[] */
    private $questions;
    /** @var Player */
    private $player;
    /** @var Chat */
    private $chat;

    /**
     * Game constructor.
     * @param GameId $gameId
     * @param Question[] $questions
     * @param Player $player
     * @param Chat $chat
     */
    public function __construct(GameId $gameId, array $questions, Player $player, Chat $chat)
    {
        $this->id = $gameId;
        Assertion::allIsInstanceOf($questions, Question::class);
        $this->questions = $questions;
        $this->player = $player;
        $this->chat = $chat;
    }

    /**
     * @return GameId
     */
    public function getId(): GameId
    {
        return $this->id;
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function getChat(): Chat
    {
        return $this->chat;
    }

    public function getCurrentQuestion(): Question
    {

    }

    public function provideAnswer(Answer $answer)
    {

        // Get current question
    }
}
