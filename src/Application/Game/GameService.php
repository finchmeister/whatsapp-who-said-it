<?php declare(strict_types=1);

namespace App\Application\Game;

use App\Domain\Game\Answer;
use App\Domain\Game\Game;
use App\Domain\Game\GameId;
use App\Domain\Game\GameRepositoryInterface;
use App\Domain\Game\Question;
use App\Domain\Game\QuestionId;
use App\Domain\Game\QuestionRepositoryInterface;

class GameService
{
    /**
     * @var GameRepositoryInterface
     */
    private $gameRepository;
    /**
     * @var QuestionRepositoryInterface
     */
    private $questionRepository;

    public function __construct(
        GameRepositoryInterface $gameRepository,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->gameRepository = $gameRepository;
        $this->questionRepository = $questionRepository;
    }

    public function getCurrentQuestion(GameId $gameId): Question
    {
        $game = $this->getGame($gameId);

        return $game->getCurrentQuestion();
    }

    public function answerQuestion(QuestionId $questionId, $answerText): Question
    {
        $question = $this->questionRepository->get($questionId);
        if ($question === null) {
            throw new \Exception('No game');
        }

        $question->submitAnswer(new Answer($answerText));

        return $question;
    }

    public function getScore(GameId $gameId): int
    {
        $game = $this->getGame($gameId);

        return $game->getScore();
    }

    public function getGame(GameId $gameId): Game
    {
        $game = $this->gameRepository->get($gameId);
        if ($game === null) {
            throw new \Exception('No game');
        }

        return $game;
    }

    // TODO, consider DTO for
}
