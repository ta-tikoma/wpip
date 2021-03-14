<?php

namespace WPIP\Packages\ANSI\Services;

use WPIP\Models\Screen\Cell\Cell;
use WPIP\Packages\ANSI\Contracts\ANSICommandsContract;

final class ANSICommands implements ANSICommandsContract
{
    private const HOME = "\033[H";

    private const NEXT = "\033[1C";

    private const CLEAR = "\033[2J";

    private const NEWLINE = "\n";

    private const CURSOR_HIDE = "\033[?25l";

    private const CURSOR_SHOW = "\033[?25h";

    private const COLOR_GREEN = "\033[42m";
    private const COLOR_RESET = "\033[0m";

    /**
     * @var resource
     */
    private $handle = STDERR;

    public function hide(): void
    {
        fwrite($this->handle, self::CURSOR_HIDE);
        fflush($this->handle);
    }

    public function home(): void
    {
        fwrite($this->handle, self::HOME);
    }

    public function show(): void
    {
        fwrite($this->handle, self::CURSOR_SHOW);
        fflush($this->handle);
    }

    public function write(Cell $cell): void
    {
        if (!is_null($cell->backgroundColor)) {
            fwrite($this->handle, self::COLOR_GREEN);
        }

        // if (!is_null($cell->value)) {
        fwrite($this->handle, $cell->value);
        // }

        if (!is_null($cell->backgroundColor)) {
            fwrite($this->handle, self::COLOR_RESET);
        }
    }

    public function newline(): void
    {
        fwrite($this->handle, self::NEWLINE);
    }

    public function clear(): void
    {
        fwrite($this->handle, self::CLEAR);
        fflush($this->handle);
    }

    public function skip(): void
    {
        fwrite($this->handle, self::NEXT);
    }

    public function flush(): void
    {
        fflush($this->handle);
    }
}
