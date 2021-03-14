<?php

namespace WPIP\Packages\Cursors;

use DI\ContainerBuilder;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Provider\ProviderContract;
use WPIP\Packages\Cursors\Contracts\CursorRepositoryContract;
use WPIP\Packages\Cursors\Listeners\CursorListener;
use WPIP\Packages\Cursors\Repositories\CursorRepository;

use function DI\add;
use function DI\get;

final class CursorsPackage implements ProviderContract
{
    public function register(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addDefinitions([
            ListenerContract::LISTENER_CONTAINER_LIST => add(get(CursorListener::class)),
            CursorRepositoryContract::class => get(CursorRepository::class)
        ]);
    }
}
