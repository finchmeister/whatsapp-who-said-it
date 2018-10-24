<?php

namespace App\Domain\Chat;

use App\Domain\Common\Id;

class Chat
{
    /** @var ChatId */
    private $id;
    /** @var string */
    private $name;
    /** @var WhatsAppChatMessage[] */
    private $messages;

    public function __construct(
        ChatId $id,
        string $name,
        array $messages
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->messages = $messages;
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
}
