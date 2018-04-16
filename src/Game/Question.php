<?php


namespace App\Game;

/**
 * Class Question
 * @package App\Game
 */
class Question
{
    /**
     * @var string
     */
    protected $question;

    /**
     * @var string
     */
    protected $answer;

    /**
     * @var string
     */
    protected $userAnswer;

    /**
     * Question constructor.
     * @param string $question
     * @param string $answer
     */
    public function __construct(
        string $question,
        string $answer
    ) {
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @return string
     */
    public function getUserAnswer(): ?string
    {
        return $this->userAnswer;
    }

    /**
     * @param string $userAnswer
     * @return Question
     */
    public function setUserAnswer(?string $userAnswer): Question
    {
        $this->userAnswer = $userAnswer;
        return $this;
    }

    public function isAnswerCorrect()
    {
        return $this->getAnswer() === $this->getUserAnswer();
    }

}
