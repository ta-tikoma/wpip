<?php

namespace WPIP\Packages\UnixTerminalInput;

use DI\ContainerBuilder;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Medium\InputProvider;
use WPIP\Contracts\Provider\ProviderContract;
use WPIP\Packages\UnixTerminalInput\Listeners\UnixTerminalInputListener;
use WPIP\Packages\UnixTerminalInput\Medium\UnixTerminalInput;

use function DI\add;
use function DI\get;

final class UnixTerminalInputPackage implements ProviderContract
{
    public function register(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addDefinitions([
            InputProvider::class => get(UnixTerminalInput::class)
        ]);

        $containerBuilder->addDefinitions([
            ListenerContract::LISTENER_CONTAINER_LIST =>
            add(get(UnixTerminalInputListener::class))
        ]);
    }
}
