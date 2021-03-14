<?php

namespace WPIP\Contracts\Listener;

use WPIP\Contracts\Listener\Event\EventContract;
use WPIP\Contracts\Listener\Status\StatusContract;
use WPIP\Models\Screen\Screen;

interface ListenerContract
{
    public const LISTENER_CONTAINER_LIST = 'LISTENER_CONTAINER_LIST';

    public function listen(EventContract $event, StatusContract $status, Screen $screen);
}
