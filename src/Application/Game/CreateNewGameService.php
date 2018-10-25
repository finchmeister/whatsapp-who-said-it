<?php

namespace App\Application\Game;

use App\Domain\Chat\ChatId;
use App\Domain\Chat\ChatRepositoryInterface;
use App\Domain\Chat\MessageFilter\MessageFilterInterface;
use App\Domain\Chat\Participant;
use App\Domain\Game\Answer;
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
    public function createNewGame(ChatId $chatId, $player, array $params = []): GameId
    {
        // TODO consider source of params
        $params = array_merge([
            'noOfQuestions' => 10
        ], $params);

        $gameId = $this->gameRepository->getNextGameId();

        // TODO: Authorise at this point?
        $chat = $this->chatRepository->get($chatId);
        if ($chat === null) {
            throw new \Exception();
        }

        $game = new Game($gameId, $player, $chat);

        $messages = $chat->getMessages();
        $participants = $chat->getParticipants();

        $answers = array_map(function (Participant $participant) {
            return new Answer($participant->getName());
        }, $participants);

        $usedIndices = [];
        $i = 0;
        while ($i < $params['noOfQuestions']) {
            $index = random_int(0, \count($messages) - 1);
            $randomMessage = $messages[$index];
            if ($this->isDuplicate($index, $usedIndices) === false
                && $this->messageFilter->isMessageSuitable($randomMessage)) {
                $usedIndices[] = $index;

                $question = new Question(
                    $this->questionRepository->getNextQuestionId(),
                    $game,
                    $randomMessage->getMessage(),
                    $answers,
                    new Answer($randomMessage->getUserName())
                );
                $game->addQuestion($question);
                $i++;
            }
        }

        $this->gameRepository->save($game);

        return $gameId;
    }

    private function isDuplicate(int $index, array $usedIndices): bool
    {
        return \in_array($index, $usedIndices, true);
    }
}
