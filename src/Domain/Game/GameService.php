<?php

namespace App\Domain\Game;

use App\Domain\Chat\Chat;
use App\Domain\Player\Player;

class GameService
{
    public const NO_OF_QUESTIONS = 10;

    public function createGame(Chat $chat, Player $player): Game
    {
        $messages = $chat->getMessages();
        $questions = [];
        $i = 0;
        while ($i < self::NO_OF_QUESTIONS) {
            $randomMessage = $messages[random_int(0, \count($messages) - 1)];
            if ($this->isMessageSuitable($randomMessage)) {
                $questions[] = new Question($randomMessage);
                $i++;
            }
        }

        return new Game($questions, $player, $chat);
    }

    protected function isMessageSuitable(string $message): bool
    {
        // TODO: consider length, stop words etc...
        return true;
    }

    ////////////////////////////////////////////////////////////////////








    public function getScore(Game $game): Score
    {

    }

    public function getCurrentQuestion(Game $game): ?Question
    {

    }

    public function answerQuestion(Answer $answer): Game
    {

    }
}
