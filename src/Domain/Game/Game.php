<?php

namespace App\Domain\Game;

use App\Domain\Chat\WhatsAppChat;
use App\Domain\Player\Player;
use Assert\Assertion;
use Ramsey\Uuid\Uuid;

class Game
{
    /** @var string */
    private $id;
    /** @var Question[] */
    private $questions;
    /** @var Player */
    private $player;
    /** @var WhatsAppChat */
    private $chat;

    /**
     * Game constructor.
     * @param Question[] $questions
     * @param Player $player
     * @param WhatsAppChat $chat
     */
    public function __construct(array $questions, Player $player, WhatsAppChat $chat)
    {
        $this->id = Uuid::uuid4()->toString();
        Assertion::allIsInstanceOf($questions, Question::class);
        $this->questions = $questions;
        $this->player = $player;
        $this->chat = $chat;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Question[]
     */
    public function getQuestions(): array
    {
        return $this->questions;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @return WhatsAppChat
     */
    public function getChat(): WhatsAppChat
    {
        return $this->chat;
    }
}
