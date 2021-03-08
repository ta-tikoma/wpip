<?php

namespace WPIP\Models\Screen\Layer;

use WPIP\Contracts\Models\LayerContract;

abstract class Layer implements LayerContract
{
    /**
     * @var Row[]
     */
    public $rows = [];

    public function __construct(int $width, int $height)
    {
        for ($i = 0; $i < $height; $i++) {
            $this->rows[] = new Row($width);
        }
    }

    public function do($callback): void
    {
        foreach ($this->rows as $y => $row) {
            foreach ($row->cells as $x => $cell) {
                $callback($cell, $x, $y);
            }
        }
    }
}
