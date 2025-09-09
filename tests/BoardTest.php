<?php
namespace Tests;
use PHPUnit\Framework\TestCase;
use App\Board;

class BoardTest extends TestCase {
    public function testDropDisc() {
        $board = new Board();
        $this->assertTrue($board->dropDisc(0, 'X'));
        $grid = $board->getGrid();
        $this->assertEquals('X', $grid[5][0]);
    }
}
