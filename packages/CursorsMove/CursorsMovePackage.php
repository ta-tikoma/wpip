<?php

namespace WPIP\Packages\CursorsMove;

use DI\ContainerBuilder;
use WPIP\Packages\Cursors\Contracts\CursorMoveContract;
use WPIP\Packages\CursorsMove\Services\CursorsMoveService;

use function DI\get;

final class CursorsMovePackage
{
    public function register(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addDefinitions([
            CursorMoveContract::class => get(CursorsMoveService::class)
        ]);
    }
}
