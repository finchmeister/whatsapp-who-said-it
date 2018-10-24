<?php declare(strict_types=1);

namespace App\Domain\Chat\MessageFilter;

interface MessageFilterInterface
{
    public function isMessageSuitable(string $message): bool;
}
