<?php

namespace WPIP\Packages\UnixTerminalInput\Listeners;

use WPIP\Contracts\Listener\Event\EventContract;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Listener\Status\StatusContract;
use WPIP\Models\Medium\Event\ExitEvent;
use WPIP\Models\Screen\Screen;

final class UnixTerminalInputListener implements ListenerContract
{
    public function listen(EventContract $event, StatusContract $status, Screen $screen)
    {
        if ($event instanceof ExitEvent) {
            system('stty -cbreak echo');
        }
    }
}
