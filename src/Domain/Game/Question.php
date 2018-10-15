<?php

namespace App\Domain\Game;

use App\Domain\Chat\WhatsAppChatMessage;
use Ramsey\Uuid\Uuid;

class Question
{
    /** @var string */
    private $id;
    /** @var string */
    private $question;
    /** @var string */
    private $answer;
    /** @var WhatsAppChatMessage */
    private $whatsAppChatMessage;
    // TODO: consider metadata

    public function __construct(
        WhatsAppChatMessage $message
    ) {
        $this->id = Uuid::uuid4()->toString();
        $this->question = $message->getMessage();
        $this->answer = $message->getUserName();
        $this->whatsAppChatMessage = $message;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @return WhatsAppChatMessage
     */
    public function getWhatsAppChatMessage(): WhatsAppChatMessage
    {
        return $this->whatsAppChatMessage;
    }
}
