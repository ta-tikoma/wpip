<?php

namespace WPIP\Packages\ANSI;

use DI\ContainerBuilder;
use WPIP\Contracts\Provider\ProviderContract;
use WPIP\Packages\ANSI\Contracts\ANSICommandsContract;
use WPIP\Packages\ANSI\Services\ANSICommands;

use function DI\get;

final class ANSIPackage implements ProviderContract
{
    public function register(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addDefinitions([
            ANSICommandsContract::class => get(ANSICommands::class)
        ]);
    }
}
