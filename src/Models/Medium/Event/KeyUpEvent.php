<?php

namespace WPIP\Models\Medium\Event;

use WPIP\Contracts\Listener\Event\EventContract;
use WPIP\Models\Keyboard\Key;

final class KeyUpEvent implements EventContract
{
    /**
     * @var Key
     */
    public $key;

    public function __construct(string $key)
    {
        $this->key = Key::fromInput($key);
    }
}
