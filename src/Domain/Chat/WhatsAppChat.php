<?php

namespace App\Domain\Chat;

class WhatsAppChat
{
    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var WhatsAppChatMessage[] */
    private $messages;
    /** @var User[] */
    private $users;

    public function __construct(
        string $name,
        array $messages
    ) {
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
