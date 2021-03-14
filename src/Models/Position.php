<?php

namespace WPIP\Models;

final class Position
{
    /**
     * @var int
     */
    public $x;

    /**
     * @var int
     */
    public $y;

    public function __construct(int $x = 0, int $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }
}
