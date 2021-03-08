<?php

namespace WPIP\Contracts\Medium;

use WPIP\Contracts\Medium\Event\EventContract;
use WPIP\Models\Screen\Screen;

interface MediumContract
{
    public function getHeight(): int;

    public function getWidth(): int;

    public function render(Screen $screen): void;

    public function event(): ?EventContract;
}
