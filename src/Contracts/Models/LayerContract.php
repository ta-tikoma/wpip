<?php

namespace WPIP\Contracts\Models;

use WPIP\Models\Size;

interface LayerContract
{
    public function __construct(Size $size);

    public function do($cellCallback, $rowCallback = null): void;
}
