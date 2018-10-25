<?php

namespace spec\App\Tests\Spec\Application\Game;

use App\Application\Game\CreateNewGameService;
use App\Domain\Chat\ChatRepositoryInterface;
use App\Domain\Chat\MessageFilter\MessageFilterInterface;
use App\Domain\Game\GameRepositoryInterface;
use App\Domain\Game\QuestionRepositoryInterface;
use PhpSpec\ObjectBehavior;

class CreateNewGameServiceSpec extends ObjectBehavior
{

    public function let(
        GameRepositoryInterface $gameRepository,
        ChatRepositoryInterface $chatRepository,
        MessageFilterInterface $messageFilter,
        QuestionRepositoryInterface $questionRepository
    ): void {
        $this->beConstructedWith(
            $gameRepository,
            $chatRepository,
            $messageFilter,
            $questionRepository
        );
    }

    public function it_can_be_initialised()
    {
        $this->shouldHaveType(CreateNewGameService::class);
    }
}
