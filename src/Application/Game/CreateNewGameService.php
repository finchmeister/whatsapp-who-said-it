<?php

namespace App\Application\Game;

use App\Domain\Chat\ChatRepositoryInterface;
use App\Domain\Chat\MessageFilter\MessageFilterInterface;
use App\Domain\Game\Game;
use App\Domain\Game\GameId;
use App\Domain\Game\GameRepositoryInterface;
use App\Domain\Game\Question;
use App\Domain\Game\QuestionRepositoryInterface;

class CreateNewGameService
{
    /**
     * @var GameRepositoryInterface
     */
    private $gameRepository;
    /**
     * @var ChatRepositoryInterface
     */
    private $chatRepository;
    /**
     * @var MessageFilterInterface
     */
    private $messageFilter;
    /**
     * @var QuestionRepositoryInterface
     */
    private $questionRepository;

    public function __construct(
        GameRepositoryInterface $gameRepository,
        ChatRepositoryInterface $chatRepository,
        MessageFilterInterface $messageFilter,
        QuestionRepositoryInterface $questionRepository
    ) {
        $this->gameRepository = $gameRepository;
        $this->chatRepository = $chatRepository;
        $this->messageFilter = $messageFilter;
        $this->questionRepository = $questionRepository;
    }

    /**
     * Implementation tbd
     * @param $chat
     * @param $player
     * @return GameId
     * @throws \Exception
     */
    public function createNewGame($chat, $player, array $params = []): GameId
    {
        // TODO consider source
        $params = array_merge([
            'noOfQuestions' => 10
        ], $params);

        $gameId = $this->gameRepository->getNextGameId();

        // TODO: Authorise at this point
        // Chat repostiory
        $chat = $this->chatRepository->get();
        if ($chat === null) {
            throw new \Exception();
        }

        $messages = $chat->getMessages();
        $questions = $usedIndices = [];
        $i = 0;
        while ($i < $params['noOfQuestions']) {
            $index = random_int(0, \count($messages) - 1);
            $randomMessage = $messages[$index];
            if ($this->isDuplicate($index, $usedIndices) === false
                && $this->messageFilter->isMessageSuitable($randomMessage)) {
                $usedIndices[] = $index;
                $questions[] = new Question(
                    $this->questionRepository->getNextQuestionId(),
                    $randomMessage
                );
                $i++;
            }
        }

        $game = new Game($gameId, $questions, $player, $chat);
        $this->gameRepository->save($game);

        return $gameId;
    }

    private function isDuplicate(int $index, array $usedIndices): bool
    {
        return \in_array($index, $usedIndices, true);
    }
}
