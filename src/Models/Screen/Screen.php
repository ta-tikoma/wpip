<?php

namespace WPIP\Models\Screen;

use WPIP\Contracts\Models\LayerContract;
use WPIP\Models\Position;
use WPIP\Models\Screen\Cell\Cell;
use WPIP\Models\Screen\Layer\OldLayer;
use WPIP\Models\Size;

final class Screen
{
    /**
     * @var Layer[]
     */
    private $layers = [];

    /**
     * @var OldLayer
     */
    private $oldLayer = null;

    /**
     * @var Size
     */
    public $size;

    public function appendLayer(string $layerName): LayerContract
    {
        $layer = new $layerName($this->size);
        $this->layers[] = $layer;
        return $layer;
    }

    public function approximationCell(Position $position): Cell
    {
        $cell = new Cell();
        foreach ($this->layers as $layer) {
            $cell->copy(
                $layer->getCell($position)
            );
        }

        return $cell;
    }

    private function approximationLayer(): LayerContract
    {
        $finalLayer = new OldLayer($this->size);

        foreach ($this->layers as $layer) {
            $finalLayer->do(function (Cell $cell, int $x, int $y) use ($layer) {
                $cell->copy($layer->rows[$y]->cells[$x]);
            });
        }

        if (!is_null($this->oldLayer)) {
            $oldLayer = $this->oldLayer;
            $finalLayer->do(function (Cell $cell, int $x, int $y) use ($oldLayer) {
                $cell->checkChange($oldLayer->rows[$y]->cells[$x]);
            });
        } else {
            $finalLayer->do(function (Cell $cell) {
                $cell->isChange = true;
            });
        }

        return $finalLayer;
    }

    public function render(): LayerContract
    {
        $layer = $this->approximationLayer();

        $this->layers = [];
        $this->oldLayer = $layer;

        return $layer;
    }
}
