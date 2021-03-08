<?php

namespace WPIP\Packages\Cursors;

use DI\Container;
use WPIP\Contracts\Medium\Event\EventContract;
use WPIP\Contracts\Package\PackageContract;
use WPIP\Models\Screen\Screen;
use WPIP\Packages\Cursors\Services\CursorService;

final class CursorsPackage implements PackageContract
{
    /**
     * @var CursorService
     */
    private $cursorService;

    public function register(Container $container): void
    {
        $this->cursorService = $container->get(CursorService::class);
    }

    public function listen(EventContract $event, Screen $screen): void
    {
        $this->cursorService->view($event, $screen);
    }
}
