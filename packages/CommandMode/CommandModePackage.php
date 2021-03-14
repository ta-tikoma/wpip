<?php

namespace WPIP\Packages\CommandMode;

use DI\ContainerBuilder;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Provider\ProviderContract;
use WPIP\Packages\CommandMode\Listeners\CommandModeListener;

use function DI\add;
use function DI\get;

final class CommandModePackage implements ProviderContract
{
    public function register(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addDefinitions([
            ListenerContract::LISTENER_CONTAINER_LIST =>
            add(get(CommandModeListener::class))
        ]);
    }
}
