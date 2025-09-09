<?php
namespace App;

class Board {
    private array $grid;

    public function __construct() {
        $this->grid = array_fill(0, 6, array_fill(0, 7, null));
    }

    public function dropDisc(int $column, string $player): bool {
        for ($i = 5; $i >= 0; $i--) {
            if ($this->grid[$i][$column] === null) {
                $this->grid[$i][$column] = $player;
                return true;
            }
        }
        return false;
    }

    public function getGrid(): array {
        return $this->grid;
    }

    public function isColumnFull(int $column): bool {
        return $this->grid[0][$column] !== null;
    }
}
