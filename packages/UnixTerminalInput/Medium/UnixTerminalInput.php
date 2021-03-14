<?php

namespace WPIP\Packages\UnixTerminalInput\Medium;

use WPIP\Contracts\Listener\Event\EventContract;
use WPIP\Contracts\Medium\InputProvider;
use WPIP\Models\Medium\Event\KeyUpEvent;

final class UnixTerminalInput implements InputProvider
{
    public function event(): ?EventContract
    {
        readline_callback_handler_install('', function () {
        });
        $char = stream_get_contents(STDIN, 1);
        // readline_callback_handler_remove();

        return new KeyUpEvent($char);
    }
}
