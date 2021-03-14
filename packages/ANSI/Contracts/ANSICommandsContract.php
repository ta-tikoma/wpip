<?php

namespace WPIP\Packages\ANSI\Contracts;

use WPIP\Models\Screen\Cell\Cell;

interface ANSICommandsContract
{
    public function hide(): void;

    public function home(): void;

    public function write(Cell $cell): void;

    public function newline(): void;

    public function clear(): void;

    public function skip(): void;

    public function flush(): void;
}
