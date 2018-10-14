<?php


namespace App\Game;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class GameContextDoctrine
 * @package App\Game
 */
class GameContextDoctrine implements GameContextInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(
        EntityManagerInterface $em
    ) {
        $this->em = $em;
    }

    public function reset(): void
    {
        // TODO: Implement reset() method.
    }

    public function newGame(GameConfigInterface $context): Game
    {
        // TODO: Implement newGame() method.
    }

    public function loadGame(GameConfigInterface $context): ?Game
    {
        // TODO: Implement loadGame() method.
    }

    public function save(Game $game): void
    {
        // TODO: Implement save() method.
    }

}