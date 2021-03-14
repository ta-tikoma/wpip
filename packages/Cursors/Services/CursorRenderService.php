<?php

namespace WPIP\Packages\Cursors\Services;

use WPIP\Models\Color;
use WPIP\Models\Keyboard\Key;
use WPIP\Models\Position;
use WPIP\Models\Screen\Screen;
use WPIP\Packages\Cursors\Contracts\CursorRepositoryContract;
use WPIP\Packages\Cursors\Models\Screen\CursorsLayer;
use WPIP\Packages\Cursors\Repositories\CursorRepository;

final class CursorRenderService
{
    /**
     * @return CursorRepository
     */
    private $cursorRepository;

    public function __construct(CursorRepositoryContract $cursorRepository)
    {
        $this->cursorRepository = $cursorRepository;
    }

    public function render(Screen $screen)
    {
        /** @var CursorsLayer $layer */
        $layer = $screen->appendLayer(CursorsLayer::class);
        foreach ($this->cursorRepository->all() as $cursor) {
            $this->setCursor($cursor->position, $screen, $layer);
            $this->unsetCursor($cursor->oldPosition, $screen, $layer);
        }
    }

    private function setCursor(
        Position $position,
        Screen $screen,
        CursorsLayer $layer
    ) {
        $cell = $layer->getCell($position);
        $cell->backgroundColor = Color::green();

        if (is_null(
            $screen->approximationCell($position)->value
        )) {
            $cell->value = Key::space()->getKey();
        }
    }

    private function unsetCursor(
        Position $position,
        Screen $screen,
        CursorsLayer $layer
    ) {
        if (is_null(
            $screen->approximationCell($position)->value
        )) {
            $layer->getCell($position)->value = Key::space()->getKey();
        }
    }
}
