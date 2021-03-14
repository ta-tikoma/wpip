<?php

namespace WPIP\Packages\UnixTerminalInput;

use DI\ContainerBuilder;
use WPIP\Contracts\Medium\InputProvider;
use WPIP\Contracts\Provider\ProviderContract;
use WPIP\Packages\UnixTerminalInput\Medium\UnixTerminalInput;

use function DI\get;

final class UnixTerminalInputPackage implements ProviderContract
{
    public function register(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addDefinitions([
            InputProvider::class => get(UnixTerminalInput::class)
        ]);
    }
}
