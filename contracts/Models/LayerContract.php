<?php

namespace WPIP\Contracts\Models;

interface LayerContract
{
    public function __construct(int $width, int $height);

    public function do($callback): void;
}
