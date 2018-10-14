<?php

namespace App\Domain\Game;

use App\Domain\Player\Player;

class Game
{
    /** @var Question[] */
    private $questions;
    /** @var Player */
    private $player;
    /** @var Answer[] */
    private $answers;
}
