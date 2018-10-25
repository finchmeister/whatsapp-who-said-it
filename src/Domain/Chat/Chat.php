<?php

namespace App\Domain\Chat;

use Assert\Assertion;

class Chat
{
    /** @var ChatId */
    private $id;
    /** @var string */
    private $name;
    /** @var WhatsAppChatMessage[] */
    private $messages;
    /** @var Participant[] */
    private $participants;

    public function __construct(
        ChatId $id,
        string $name,
        array $messages,
        array $participants
    ) {
        $this->id = $id;
        Assertion::notBlank($name);
        $this->name = $name;
        Assertion::allIsInstanceOf($messages, WhatsAppChatMessage::class);
        $this->messages = $messages;
        Assertion::allIsInstanceOf($participants, Participant::class);
        $this->participants = $participants;
    }

    public function getId(): ChatId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return WhatsAppChatMessage[]
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @return Participant[]
     */
    public function getParticipants(): array
    {
        return $this->participants;
    }
}
