<?php

namespace WPIP\Packages\FileView;

use DI\ContainerBuilder;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Provider\ProviderContract;
use WPIP\Packages\FileView\Listeners\FileViewListener;

use function DI\add;
use function DI\get;

final class FileViewPackage implements ProviderContract
{
    public function register(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addDefinitions([
            ListenerContract::LISTENER_CONTAINER_LIST =>
            add(get(FileViewListener::class))
        ]);
    }
}
