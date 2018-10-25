<?php

namespace App\Domain\Game;

interface QuestionRepositoryInterface
{
    public function get(QuestionId $questionId): ?Question;

    public function getNextQuestionId(): QuestionId;
}
