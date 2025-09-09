<?php
namespace App;

class Game {
    private Board $board;
    private string $currentPlayer;
    private ?string $winner;

    public function __construct() {
        $this->board = new Board();
        $this->currentPlayer = 'X';
        $this->winner = null;
    }

    public function playTurn(int $column): bool {
        if ($this->winner || $this->board->isColumnFull($column)) {
            return false;
        }

        if ($this->board->dropDisc($column, $this->currentPlayer)) {
            if ($this->checkWin()) {
                $this->winner = $this->currentPlayer;
            } else {
                $this->currentPlayer = $this->currentPlayer === 'X' ? 'O' : 'X';
            }
            return true;
        }

        return false;
    }

    public function getBoard(): Board {
        return $this->board;
    }

    public function getCurrentPlayer(): string {
        return $this->currentPlayer;
    }

    public function getWinner(): ?string {
        return $this->winner;
    }

    private function checkWin(): bool {
        $grid = $this->board->getGrid();
        $rows = count($grid);
        $cols = count($grid[0]);
        $player = $this->currentPlayer;

        // horizontal
        for ($r = 0; $r < $rows; $r++) {
            for ($c = 0; $c <= $cols - 4; $c++) {
                if ($grid[$r][$c] === $player &&
                    $grid[$r][$c+1] === $player &&
                    $grid[$r][$c+2] === $player &&
                    $grid[$r][$c+3] === $player) return true;
            }
        }

        // vertical
        for ($c = 0; $c < $cols; $c++) {
            for ($r = 0; $r <= $rows - 4; $r++) {
                if ($grid[$r][$c] === $player &&
                    $grid[$r+1][$c] === $player &&
                    $grid[$r+2][$c] === $player &&
                    $grid[$r+3][$c] === $player) return true;
            }
        }

        // diagonale \
        for ($r = 0; $r <= $rows - 4; $r++) {
            for ($c = 0; $c <= $cols - 4; $c++) {
                if ($grid[$r][$c] === $player &&
                    $grid[$r+1][$c+1] === $player &&
                    $grid[$r+2][$c+2] === $player &&
                    $grid[$r+3][$c+3] === $player) return true;
            }
        }

        // diagonale /
        for ($r = 3; $r < $rows; $r++) {
            for ($c = 0; $c <= $cols - 4; $c++) {
                if ($grid[$r][$c] === $player &&
                    $grid[$r-1][$c+1] === $player &&
                    $grid[$r-2][$c+2] === $player &&
                    $grid[$r-3][$c+3] === $player) return true;
            }
        }

        return false;
    }
}
