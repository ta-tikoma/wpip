<?php

namespace WPIP\Packages\Cursors\Services;

use WPIP\Contracts\Medium\Event\EventContract;
use WPIP\contracts\Medium\Event\KeyUpEvent;
use WPIP\Models\Screen\Cell\Color;
use WPIP\Models\Screen\Screen;
use WPIP\Packages\Cursors\Models\Cursor;
use WPIP\Packages\Cursors\Models\Screen\CursorsLayer;

final class CursorService
{
    /**
     * @var Cursor[]
     */
    public $cursors = [];

    public function __construct()
    {
        $this->cursors[] = new Cursor();
    }

    public function view(EventContract $event, Screen $screen)
    {
        $this->move($event);

        /** @var CursorsLayer $layer */
        $layer = $screen->appendLayer(CursorsLayer::class);
        foreach ($this->cursors as $cursor) {
            $layer
                ->rows[$cursor->y]
                ->cells[$cursor->x]
                ->backgroundColor = Color::green();
        }
    }

    private function move(EventContract $event)
    {
        if (!($event instanceof KeyUpEvent)) {
            return;
        }

        switch ($event->key) {
            case 'j':
                $this->last()->down();
                break;
            case 'k':
                $this->last()->up();
                break;
            case 'h':
                $this->last()->left();
                break;
            case 'l':
                $this->last()->right();
                break;
        }
    }

    private function last(): Cursor
    {
        return $this->cursors[count($this->cursors) - 1];
    }
}
