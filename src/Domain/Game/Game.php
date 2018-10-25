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

    public function __construct(GameId $gameId, Player $player, Chat $chat)
    {
        $this->id = $gameId;
        $this->player = $player;
        $this->chat = $chat;
    }

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

    public function addQuestion(Question $question): void
    {
        $this->questions[] = $question;
    }

    /**
     * @param Question[] $questions
     */
    public function setQuestions(array $questions): void
    {
        Assertion::allIsInstanceOf($questions, Question::class);
        $this->questions = $questions;
    }

    /**
     * @return Question[]
     */
    public function getQuestions(): array
    {
        return $this->questions;
    }

    public function getCurrentQuestion(): ?Question
    {
        foreach ($this->getQuestions() as $question) {
            if ($question->getAnswer() === null) {
                return $question;
            }
        }

        return null;
    }

    /**
     * @param Answer $answer
     * @return Question
     * @throws \LogicException
     */
    public function provideAnswer(Answer $answer): Question
    {
        $question = $this->getCurrentQuestion();
        if ($question === null) {
            throw new \LogicException('Answering an already answered question');
        }
        $question->submitAnswer($answer);

        return $question;
    }

    public function getScore(): int
    {
        $score = 0;
        foreach ($this->getQuestions() as $question) {
            if ($question->getAnswer() === null) {
                return $score;
            }
            if ($question->isAnswerCorrect()) {
                $score++;
            }
        }

        return $score;
    }
}
