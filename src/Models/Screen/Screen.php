<?php

namespace WPIP\Models\Screen;

use WPIP\Contracts\Models\LayerContract;
use WPIP\Models\Screen\Cell\Cell;
use WPIP\Models\Screen\Layer\OldLayer;

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
     * @var int
     */
    public $width;

    /**
     * @var int
     */
    public $height;

    public function appendLayer(string $layerName): LayerContract
    {
        $layer = new $layerName($this->width, $this->height);
        $this->layers[] = $layer;
        return $layer;
    }

    private function approximation(): LayerContract
    {
        $finalLayer = new OldLayer($this->width, $this->height);

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
        $layer = $this->approximation();

        $this->layers = [];
        $this->oldLayer = $layer;

        return $layer;
    }
}
