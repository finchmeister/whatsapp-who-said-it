<?php

namespace App\Infrastructure\Chat;

use App\Domain\Chat\ChatDataProviderInterface;

class LocalDataProvider implements ChatDataProviderInterface
{
    public function read(string $fileName): string
    {
        return file_get_contents($fileName);
    }
}
