<?php

namespace WPIP\Packages\UnixTerminalOutput\Medium;

use WPIP\Contracts\Medium\OutputPortContract;
use WPIP\Models\Screen\Cell\Cell;
use WPIP\Models\Screen\Screen;
use WPIP\Models\Size;
use WPIP\Packages\ANSI\Contracts\ANSICommandsContract;

final class UnixTerminalOutput implements OutputPortContract
{
    /**
     * @var ANSICommandsContract
     */
    private $ANSICommands;

    public function __construct(ANSICommandsContract $ANSICommands)
    {
        $ANSICommands->hide();
        $ANSICommands->clear();

        $this->ANSICommands = $ANSICommands;
    }

    public function getSize(): Size
    {
        return new Size(
            exec('tput cols'),
            exec('tput lines')
        );
    }

    public function render(Screen $screen): void
    {
        // file_put_contents('debug.log', "\nSTART\n", FILE_APPEND);
        // file_put_contents('debug.log', $screen->size->width, FILE_APPEND);
        $layer = $screen->render();
        $ANSICommands = $this->ANSICommands;

        $ANSICommands->home();
        $layer->do(
            function (Cell $cell) use ($ANSICommands) {
                if (!$cell->isChange) {
                    $ANSICommands->skip();
                    return;
                }

                file_put_contents('debug.log', "'$cell->value'", FILE_APPEND);
                $ANSICommands->write($cell);
            },
            function (int $y) use ($ANSICommands, $screen) {
                if ($screen->size->height - 1 !== $y) {
                    $ANSICommands->newline();
                }
            }
        );
        $ANSICommands->flush();
    }
}
