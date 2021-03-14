<?php

namespace WPIP\Models\Screen\Layer;

use WPIP\Contracts\Models\LayerContract;
use WPIP\Models\Position;
use WPIP\Models\Screen\Cell\Cell;
use WPIP\Models\Size;

abstract class Layer implements LayerContract
{
    /**
     * @var Row[]
     */
    public $rows = [];

    public function __construct(Size $size)
    {
        for ($i = 0; $i < $size->height; $i++) {
            $this->rows[] = new Row($size->width);
        }
    }

    public function getCell(Position $position): Cell
    {
        return $this
            ->rows[$position->y]
            ->cells[$position->x];
    }

    public function do($cellCallback, $rowCallback = null): void
    {
        foreach ($this->rows as $y => $row) {
            foreach ($row->cells as $x => $cell) {
                $cellCallback($cell, $x, $y);
            }
            if (!is_null($rowCallback)) {
                $rowCallback($y);
            }
        }
    }
}
