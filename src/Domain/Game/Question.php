<?php

namespace App\Domain\Game;

use App\Domain\Chat\WhatsAppChatMessage;
use App\Domain\Common\Id;

class Question
{
    /** @var QuestionId */
    private $id;
    /** @var string */
    private $question;
    /** @var Answer */
    private $answer;
    /** @var WhatsAppChatMessage */
    private $whatsAppChatMessage;
    // TODO: consider metadata

    private $providedAnswer;

    public function __construct(
        QuestionId $id,
        WhatsAppChatMessage $message
    ) {
        $this->id = $id;
        $this->question = $message->getMessage();
        $this->answer = $message->getUserName();
        $this->whatsAppChatMessage = $message;
    }

    /**
     * @return QuestionId
     */
    public function getId(): QuestionId
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

    /** Todo */
    public function setProvidedAnswer($providedAnswer)
    {
        $this->providedAnswer = $providedAnswer;
    }
}
