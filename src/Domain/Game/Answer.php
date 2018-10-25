<?php

namespace App\Domain\Game;

use Assert\Assertion;

class Answer
{
    /** @var string */
    private $answerText;

    public function __construct(
        string $answer
    ) {
        Assertion::notBlank($answer);
        $this->answerText = $answer;
    }

    public function getAnswerText(): string
    {
        return $this->answerText;
    }
}
