<?php

namespace WPIP\Packages\UnixTerminalInput\Medium;

use WPIP\Contracts\Listener\Event\EventContract;
use WPIP\Contracts\Medium\InputProvider;
use WPIP\Models\Medium\Event\KeyUpEvent;

final class UnixTerminalInput implements InputProvider
{
    private $stdin;

    public function __construct()
    {
        system('stty cbreak -echo');
        $this->stdin = fopen('php://stdin', 'r');
    }

    // public function event(): ?EventContract
    // {
    //     readline_callback_handler_install('', function () {
    //     });
    //     $char = stream_get_contents(STDIN, 1);
    //     // readline_callback_handler_remove();
    //
    //     return new KeyUpEvent($char);
    // }

    public function event(): ?EventContract
    {
        $char = fgetc($this->stdin);

        return new KeyUpEvent($char);
    }
}
