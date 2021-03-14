<?php

namespace WPIP\Packages\UnixTerminalOutput\Listeners;

use WPIP\Contracts\Listener\Event\EventContract;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Listener\Status\StatusContract;
use WPIP\Models\Medium\Event\ExitEvent;
use WPIP\Models\Screen\Screen;
use WPIP\Packages\ANSI\Contracts\ANSICommandsContract;

final class UnixTerminalOutputListener implements ListenerContract
{
    /**
     * @var ANSICommandsContract
     */
    private $ANSICommands;

    public function __construct(ANSICommandsContract $ANSICommands)
    {
        $this->ANSICommands = $ANSICommands;
    }

    public function listen(EventContract $event, StatusContract $status, Screen $screen)
    {
        if ($event instanceof ExitEvent) {
            $this->ANSICommands->show();
        }
    }
}
