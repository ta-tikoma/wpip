<?php

namespace WPIP\Packages\CursorsMove\Services;

use WPIP\Models\Keyboard\Key;
use WPIP\Models\Medium\Event\KeyUpEvent;
use WPIP\Packages\Cursors\Contracts\CursorMoveContract;
use WPIP\Packages\Cursors\Contracts\CursorRepositoryContract;
use WPIP\Packages\Cursors\Repositories\CursorRepository;

final class CursorsMoveService implements CursorMoveContract
{
    /**
     * @return CursorRepository
     */
    private $cursorRepository;

    public function __construct(CursorRepositoryContract $cursorRepository)
    {
        $this->cursorRepository = $cursorRepository;
    }

    public function move(KeyUpEvent $event)
    {
        if ($event->key->equal(Key::j())) {
            $this->cursorRepository->last()->down();
        } elseif ($event->key->equal(Key::k())) {
            $this->cursorRepository->last()->up();
        } elseif ($event->key->equal(Key::h())) {
            $this->cursorRepository->last()->left();
        } elseif ($event->key->equal(Key::l())) {
            $this->cursorRepository->last()->right();
        }
    }
}
