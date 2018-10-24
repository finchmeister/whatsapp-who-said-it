<?php

namespace App\Domain\Game;

interface QuestionRepositoryInterface
{
    public function get(QuestionId $questionId): ?Question;

    public function getNextQuestionId(): QuestionId;

    /** Todo is this needed? */
    public function save(Question $question): void;
}
