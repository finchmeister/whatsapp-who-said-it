<?php

namespace App\Domain\Chat;

use Ramsey\Uuid\Uuid;

class WhatsAppChat
{
    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var WhatsAppChatMessage[] */
    private $messages;

    public function __construct(
        string $name,
        array $messages
    ) {
        $this->id = Uuid::uuid4()->toString();
        $this->name = $name;
        $this->messages = $messages;
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
