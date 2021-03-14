<?php

namespace WPIP\Models\Medium\Event;

use WPIP\Contracts\Listener\Event\EventContract;

final class StartEvent implements EventContract
{
    /**
     * @var array
     */
    public $arguments;

    public function __construct()
    {
        $this->arguments = $_SERVER['argv'];
    }
}
