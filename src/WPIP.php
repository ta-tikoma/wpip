<?php

namespace WPIP;

use WPIP\Contracts\Listener\Event\EventContract;
use WPIP\Models\Listener\Status\Status;
use WPIP\Models\Medium\Event\ExitEvent;
use WPIP\Models\Medium\Event\StartEvent;

final class WPIP extends WPIPLoader
{
    public function run()
    {
        $status = new Status();

        $this->sendEvent(new StartEvent(), $status);

        while (true) {
            $this->sendEvent(
                $this->inputProvider->event()
            );
        }
    }

    public function sendEvent(
        EventContract $event
    ) {
        $this->screen->size = $this->outputPort->getSize();

        foreach ($this->listeners as $listener) {
            $listener->listen($event, $this->status, $this->screen);
        }

        $this->outputPort->render($this->screen);

        if ($event instanceof ExitEvent) {
            die(1);
        }
    }
}
