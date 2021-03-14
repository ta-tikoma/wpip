<?php

namespace WPIP\Packages\CommandMode\Listeners;

use WPIP\Contracts\Listener\Event\EventContract;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Listener\Status\StatusContract;
use WPIP\Contracts\WPIPContract;
use WPIP\Models\Keyboard\Key;
use WPIP\Models\Medium\Event\ExitEvent;
use WPIP\Models\Medium\Event\KeyUpEvent;
use WPIP\Models\Screen\Screen;
use WPIP\Packages\CommandMode\Models\Screen\CommandLineLayer;

final class CommandModeListener implements ListenerContract
{
    /**
     * @var Key[]
     */
    private $line = [];

    /**
     * @var WPIPContract
     */
    private $wpip;

    public function __construct(WPIPContract $wpip)
    {
        $this->wpip = $wpip;
    }

    public function listen(EventContract $event, StatusContract $status, Screen $screen)
    {
        $this->handle($event, $status);
        $this->render($screen);
    }

    private function handle(EventContract $event, StatusContract $status)
    {
        if (!($event instanceof KeyUpEvent)) {
            return;
        }

        if ($status->isEmpty()) {
            if ($event->key->equal(Key::colon())) {
                $status->add(self::class);
            }
        }

        if ($status->has(self::class)) {
            switch (true) {
                case $event->key->equal(Key::enter()):
                    $this->callCommand();
                    $status->remove(self::class);
                    $this->line = [];
                    break;
                case $event->key->equal(Key::esc()):
                    $status->remove(self::class);
                    $this->line = [];
                    break;
                case $event->key->equal(Key::backspace()):
                    if (count($this->line)) {
                        array_pop($this->line);
                    }
                    break;
                default:
                    $this->append($event->key);
                    break;
            }
        }
    }

    private function append(Key $key)
    {
        $this->line[] = $key;
    }

    private function callCommand()
    {
        switch (true) {
            case $this->compare([Key::colon(), Key::q()]):
                $this->wpip->sendEvent(new ExitEvent());
                return;
        }
    }

    private function compare(array $command): bool
    {
        foreach ($command as $index => $key) {
            if (!isset($this->line[$index])) {
                return false;
            }
            if (!$this->line[$index]->equal($key)) {
                return false;
            }
        }

        return true;
    }

    private function render(Screen $screen)
    {
        /** @var CommandLineLayer $layer */
        $layer = $screen->appendLayer(CommandLineLayer::class);

        $lastRow = $layer->rows[count($layer->rows) - 1];
        foreach ($lastRow->cells as $index => $cell) {
            if (isset($this->line[$index - 1])) {
                $cell->value = $this->line[$index - 1]->getKey();
            } else {
                $cell->value = Key::space()->getKey();
            }
        }
    }
}
