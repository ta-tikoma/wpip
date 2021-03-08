<?php

namespace WPIP\Packages\Cursors\Models;

final class Cursor
{
    /**
     * @var int
     */
    public $x = 0;

    /**
     * @var int
     */
    public $y = 0;

    public function up(int $step = 1)
    {
        $this->y -= $step;

        if ($this->y < 0) {
            $this->y = 0;
        }
    }

    public function down(int $step = 1)
    {
        $this->y += $step;
    }

    public function left(int $step = 1)
    {
        $this->x -= $step;

        if ($this->x < 0) {
            $this->x = 0;
        }
    }

    public function right(int $step = 1)
    {
        $this->x += $step;
    }
}
