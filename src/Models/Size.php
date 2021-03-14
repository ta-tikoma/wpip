<?php

namespace WPIP\Models;

final class Size
{
    /**
     * @var int
     */
    public $height;

    /**
     * @var int
     */
    public $width;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }
}
