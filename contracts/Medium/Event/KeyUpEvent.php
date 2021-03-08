<?php

namespace WPIP\contracts\Medium\Event;

use WPIP\Contracts\Medium\Event\EventContract;

final class KeyUpEvent implements EventContract
{
    /**
     * @var string
     */
    public $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }
}
