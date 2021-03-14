<?php

namespace WPIP\Packages\Cursors\Listeners;

use WPIP\Contracts\Listener\Event\EventContract;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Listener\Status\StatusContract;
use WPIP\Models\Medium\Event\KeyUpEvent;
use WPIP\Models\Screen\Screen;
use WPIP\Packages\Cursors\Contracts\CursorMoveContract;
use WPIP\Packages\Cursors\Services\CursorRenderService;

final class CursorListener implements ListenerContract
{
    /**
     * @var CursorMoveContract
     */
    private $cursorMove;

    /**
     * @var CursorRenderService
     */
    private $cursorRender;

    public function __construct(
        CursorMoveContract $cursorMove,
        CursorRenderService $cursorRender
    ) {
        $this->cursorRender = $cursorRender;
        $this->cursorMove = $cursorMove;
    }

    public function listen(EventContract $event, StatusContract $status, Screen $screen)
    {
        if ($status->isEmpty()) {
            if ($event instanceof KeyUpEvent) {
                $this->cursorMove->move($event);
            }
        }


        $this->cursorRender->render($screen);
    }
}
