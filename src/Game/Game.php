<?php


namespace App\Game;

use Doctrine\Common\Collections\Collection;
use Webmozart\Assert\Assert;

class Game
{
    /**
     * @var Question[]|Collection
     */
    protected $questions;

    /**
     * @var int
     */
    protected $currentQuestionNo = 1;

    public function __construct(
        Collection $questions
    ) {
        Assert::allIsInstanceOf($questions, Question::class);
        $this->questions = $questions;
    }

    public function getCurrentQuestionNo(): int
    {
        return $this->currentQuestionNo;
    }

    public function setCurrentQuestionNo(int $currentQuestionNo): void
    {
        $this->currentQuestionNo = $currentQuestionNo;
    }
}
