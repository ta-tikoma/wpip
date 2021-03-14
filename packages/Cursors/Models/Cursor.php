<?php

namespace WPIP\Packages\Cursors\Models;

use WPIP\Models\Position;

final class Cursor
{
    /**
     * @var Position
     */
    public $position;

    /**
     * @var Position
     */
    public $oldPosition;

    public function __construct()
    {
        $this->position = new Position();
        $this->oldPosition = new Position();
    }

    public function up(int $step = 1)
    {
        $this->oldPosition = clone $this->position;

        $this->position->y -= $step;

        if ($this->position->y < 0) {
            $this->position->y = 0;
        }
    }

    public function down(int $step = 1)
    {
        $this->oldPosition = clone $this->position;
        $this->position->y += $step;
    }

    public function left(int $step = 1)
    {
        $this->oldPosition = clone $this->position;
        $this->position->x -= $step;

        if ($this->position->x < 0) {
            $this->position->x = 0;
        }
    }

    public function right(int $step = 1)
    {
        $this->oldPosition = clone $this->position;
        $this->position->x += $step;
    }
}
