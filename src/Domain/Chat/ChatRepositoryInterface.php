<?php declare(strict_types=1);

namespace App\Domain\Chat;

interface ChatRepositoryInterface
{
    public function get(ChatId $chatId): ?Chat;

    public function getNextChatId(): ChatId;

    public function save(Chat $game): void;
}
