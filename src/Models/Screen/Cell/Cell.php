<?php

namespace WPIP\Models\Screen\Cell;

use WPIP\Models\Cell\Color;
use WPIP\Models\Cell\Style;

final class Cell
{
    /**
     * @var string|null
     */
    public $value;

    /**
     * @var Style|null
     */
    public $style;

    /**
     * @var Color|null
     */
    public $foregroundColor;

    /**
     * @var Color|null
     */
    public $backgroundColor;

    /**
     * @var bool
     */
    public $isChange;

    private function equal(Cell $cell): bool
    {
        if ($this->value !== $cell->value) {
            return false;
        }

        if ($this->style !== $cell->style) {
            return false;
        }

        if ($this->foregroundColor !== $cell->foregroundColor) {
            return false;
        }

        if ($this->backgroundColor !== $cell->backgroundColor) {
            return false;
        }

        return true;
    }

    public function checkChange(Cell $cell): void
    {
        $this->isChange = !$this->equal($cell);
    }

    public function copy(Cell $cell): void
    {
        if ($cell->isEmpty()) {
            return;
        }

        if (!is_null($cell->value)) {
            $this->value = $cell->value;
        }
        if (!is_null($cell->style)) {
            $this->style = $cell->style;
        }
        if (!is_null($cell->foregroundColor)) {
            $this->foregroundColor = $cell->foregroundColor;
        }
        if (!is_null($cell->backgroundColor)) {
            $this->backgroundColor = $cell->backgroundColor;
        }
    }

    private function isEmpty(): bool
    {
        return is_null($this->value)
            && is_null($this->style)
            && is_null($this->foregroundColor)
            && is_null($this->backgroundColor);
    }
}
