<?php

namespace App\Domain\Game;

class Score
{
    /** @var int */
    private $score;
    /** @var int */
    private $maxScore;

    public function __construct(
        int $score,
        int $maxScore
    ) {
        $this->score = $score;
        $this->maxScore = $maxScore;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @return int
     */
    public function getMaxScore(): int
    {
        return $this->maxScore;
    }
}
