<?php

namespace WPIP\Contracts;

use WPIP\Contracts\Listener\Event\EventContract;

interface WPIPContract
{
    public function sendEvent(EventContract $event);
}
