<?php

namespace App\Domain\Game;

use App\Domain\Chat\WhatsAppChat;
use App\Domain\Player\Player;
use App\Game\Game;

class GetGame
{
    /**
     * @var GameRepositoryInterface
     */
    private $gameRepository;
    /**
     * @var CreateGameInterface
     */
    private $createGame;

    public function __construct(
        GameRepositoryInterface $gameRepository,
        CreateGameInterface $createGame
    ) {
        $this->gameRepository = $gameRepository;
        $this->createGame = $createGame;
    }

    public function getPlayersGame(Player $player, WhatsAppChat $chat): Game
    {
        $game = $this->gameRepository->findByPlayerAndChat(
            $player,
            $chat
        );

        if ($game === null) {
            $game = $this->createGame->createNewGame(
                $player,
                $chat
            );
        }

        return $game;
    }
}