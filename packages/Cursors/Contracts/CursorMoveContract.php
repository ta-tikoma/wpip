<?php

namespace WPIP\Packages\Cursors\Contracts;

use WPIP\Models\Medium\Event\KeyUpEvent;

interface CursorMoveContract
{
    public function move(KeyUpEvent $event);
}
