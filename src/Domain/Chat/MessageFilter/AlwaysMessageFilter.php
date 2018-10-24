<?php declare(strict_types=1);

namespace App\Domain\Chat\MessageFilter;

class AlwaysMessageFilter implements MessageFilterInterface
{
    public function isMessageSuitable(string $message): bool
    {
        return true;
    }
}
