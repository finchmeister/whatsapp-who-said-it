<?php

namespace App\Domain\Chat;

class WhatsAppChatMessage
{
    /** @var \DateTimeInterface */
    private $timestamp;

    /** @var User */
    private $user;

    /** @var string */
    private $userName;

    /** @var string */
    private $message;

    /**
     * @return \DateTimeInterface
     */
    public function getTimestamp(): \DateTimeInterface
    {
        return $this->timestamp;
    }

    /**
     * @param \DateTimeInterface $timestamp
     * @return WhatsAppChatMessage
     */
    public function setTimestamp(\DateTimeInterface $timestamp): WhatsAppChatMessage
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return WhatsAppChatMessage
     */
    public function setUser(User $user): WhatsAppChatMessage
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return WhatsAppChatMessage
     */
    public function setUserName(string $userName): WhatsAppChatMessage
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return WhatsAppChatMessage
     */
    public function setMessage(string $message): WhatsAppChatMessage
    {
        $this->message = $message;
        return $this;
    }




}
