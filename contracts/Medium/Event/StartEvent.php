<?php

namespace WPIP\Contracts\Medium\Event;

use WPIP\Contracts\Medium\Event\EventContract;

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
