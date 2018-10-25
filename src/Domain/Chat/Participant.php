<?php

namespace App\Domain\Chat;

use Assert\Assertion;

class Participant
{
    /**
     * @var string
     */
    private $name;

    public function __construct(
        string $name
    ) {
        Assertion::notBlank($name);
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
