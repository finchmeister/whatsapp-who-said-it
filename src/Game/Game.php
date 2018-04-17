<?php


namespace App\Game;

use Doctrine\Common\Collections\Collection;

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

    public function __construct()
    {
    }

    /**
     * @param Question[]|Collection $questions
     * @return Game
     */
    public function setQuestions(Collection $questions): Game
    {
        $this->questions = $questions;
        return $this;
    }

    public function getCurrentQuestionNo(): int
    {
        return $this->currentQuestionNo;
    }

    public function getCurrentQuestion(): Question
    {
        return $this->questions->get($this->getCurrentQuestionNo());
    }

    public function getScore(): int
    {

    }

    public function restartGame()
    {
        $this->currentQuestionNo = 1;
    }

}