<?php
declare(strict_types = 1);

namespace App\Domain\Common;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Id
{
    /**
     * @param string $aId
     * @return Id
     */
    public static function fromString(string $aId): Id
    {
        return new self(Uuid::fromString($aId));
    }

    public static function generate(): Id
    {
        return new self(Uuid::uuid4());
    }

    /**
     * @var Uuid
     */
    private $uuid;

    /**
     * Always provide a string representation of the GameId to construct the VO
     * 
     * @param UuidInterface $aUuid
     * 
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(UuidInterface $aUuid)
    {
        $this->uuid = $aUuid;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->uuid->toString();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * @param self $other
     * @return bool
     */
    public function sameValueAs(self $other): bool
    {
        return $this->toString() === $other->toString();
    }
}
