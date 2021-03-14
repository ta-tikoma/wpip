<?php

namespace WPIP\CommandMode\Services;

use WPIP\Contracts\Medium\Event\EventContract;
use WPIP\Models\Keyboard\Key;
use WPIP\Models\Medium\Event\KeyUpEvent;
use WPIP\Models\Package\ListenResult;
use WPIP\Models\Screen\Screen;

final class CommandModeService
{
    private $line;

    public function listen(EventContract $event, ListenResult $result): ListenResult
    {
        if (!($event instanceof KeyUpEvent)) {
            return $result;
        }

        if ($result->isEmpty()) {
            if ($event->key->equal(Key::colon())) {
            }
        }

        if ($result->has(self::class)) {
        }

        return $result;
    }

    public function render(Screen $screen)
    {
    }
}
