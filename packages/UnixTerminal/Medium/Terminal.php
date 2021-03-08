<?php

namespace WPIP\Packages\UnixTerminal\Medium;

use WPIP\Contracts\Medium\Event\KeyUpEvent;
use WPIP\Contracts\Medium\Event\EventContract;
use WPIP\Contracts\Medium\MediumContract;
use WPIP\Models\Screen\Cell\Cell;
use WPIP\Models\Screen\Screen;

final class Terminal implements MediumContract
{
    /**
     * @var Unix
     */
    private $unix;

    public function __construct(Unix $unix)
    {
        $unix->hide();
        $unix->clear();

        $this->unix = $unix;
    }

    public function getHeight(): int
    {
        return exec('tput lines');
    }

    public function getWidth(): int
    {
        return exec('tput cols');
    }

    public function render(Screen $screen): void
    {
        // file_put_contents('debug.log', "\nSTART\n", FILE_APPEND);
        $layer = $screen->render();
        $unix = $this->unix;
        $width = $screen->width - 1;

        $unix->home();
        $layer->do(function (Cell $cell, int $x) use ($unix, $width) {
            if (!$cell->isChange) {
                $unix->skip();
                return;
            }

            $unix->write($cell);

            if ($x === $width) {
                $unix->newline();
            }
        });
        $unix->flush();
    }

    public function event(): ?EventContract
    {
        readline_callback_handler_install('', function () {
        });
        $char = stream_get_contents(STDIN, 1);
        readline_callback_handler_remove();

        return new KeyUpEvent($char);
    }
}
