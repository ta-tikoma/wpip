<?php

namespace WPIP\Contracts\Medium;

use WPIP\Models\Screen\Screen;
use WPIP\Models\Size;

interface OutputPortContract
{
    public function getSize(): Size;

    public function render(Screen $screen): void;
}
