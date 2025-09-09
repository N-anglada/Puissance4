<?php
namespace Tests;
use PHPUnit\Framework\TestCase;
use App\Game;

class GameTest extends TestCase {
    public function testPlayTurnSwitchesPlayer() {
        $game = new Game();
        $currentPlayer = $game->getCurrentPlayer();
        $game->playTurn(0);
        $this->assertNotEquals($currentPlayer, $game->getCurrentPlayer());
    }
}
