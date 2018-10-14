<?php


namespace App\Game;

/**
 * Interface GameConfigInterface
 * @package App\Game
 */
interface GameConfigInterface
{
    public function getId();

    public function getChat();

    public function getGameMode();

    public function getUser();
}