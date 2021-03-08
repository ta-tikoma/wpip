<?php

namespace WPIP\Models\Screen\Layer;

use WPIP\Models\Screen\Cell\Cell;

final class Row
{
    /**
     * @var Cell[]
     */
    public $cells = [];

    public function __construct(int $width)
    {
        for ($i = 0; $i < $width; $i++) {
            $this->cells[] = new Cell();
        }
    }
}
