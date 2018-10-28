<?php

namespace App\Domain\Game;

use Assert\Assertion;

class Question
{
    /** @var QuestionId */
    private $id;
    /** @var string */
    private $questionText;
    /** @var Answer */
    private $answer;
    /** @var Game */
    private $game;
    // TODO: consider metadata

    private $submittedAnswerText;
    /** @var Answer[] */
    private $answers;

    public function __construct(
        QuestionId $id,
//        Game $game,
        string $questionText,
        array $answers,
        Answer $answer
    ) {
        $this->id = $id;
        $this->questionText = $questionText;
        Assertion::allIsInstanceOf($answers, Answer::class);
        $this->answers = $answers;
        $this->answer = $answer;
//        $this->game = $game;
    }

    public function getId(): QuestionId
    {
        return $this->id;
    }

    public function getGame(): Game
    {
        return $this->game;
    }

    public function getQuestionText(): string
    {
        return $this->questionText;
    }

    public function getAnswer(): Answer
    {
        return $this->answer;
    }

    public function getAnswerText(): string
    {
        return $this->answer->getAnswerText();
    }

    /**
     * @return Answer[]
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }

    /**
     * @return array
     */
    public function getAnswersText(): array
    {
        return array_map(function (Answer $answer) {
            return $answer->getAnswerText();
        }, $this->getAnswers());
    }

    public function submitAnswer(Answer $answer): void
    {
        $this->submittedAnswerText = $answer->getAnswerText();
    }

    public function getSubmittedAnswerText(): ?string
    {
        return $this->submittedAnswerText;
    }

    public function isAnswerCorrect(): bool
    {
        return $this->getAnswerText() === $this->submittedAnswerText;
    }
}
