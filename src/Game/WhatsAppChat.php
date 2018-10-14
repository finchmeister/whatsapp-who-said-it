<?php


namespace App\Game;


use App\Entity\User;
use Doctrine\Common\Collections\Collection;

class WhatsAppChat
{
    /** @var string */
    private $name;

    /** @var WhatsAppChatMessage[]|Collection */
    private $messages;

    /** @var User[] */
    private $users;

    public function __construct(
        string $name
    ) {
        $this->name = $name;
    }

    /**
     * @return WhatsAppChatMessage[]|Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param WhatsAppChatMessage[]|Collection $messages
     * @return WhatsAppChat
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
        return $this;
    }



}