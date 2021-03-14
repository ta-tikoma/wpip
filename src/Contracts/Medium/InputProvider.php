<?php

namespace WPIP\Contracts\Medium;

use WPIP\Contracts\Listener\Event\EventContract;

interface InputProvider
{
    public function event(): ?EventContract;
}
