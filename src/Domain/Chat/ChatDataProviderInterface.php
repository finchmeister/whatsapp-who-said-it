<?php

namespace App\Domain\Chat;

interface ChatDataProviderInterface
{
    public function read(string $fileName): string;
}
