<?php

namespace WPIP\Packages\UnixTerminalOutput;

use DI\ContainerBuilder;
use WPIP\Contracts\Medium\OutputPortContract;
use WPIP\Contracts\Provider\ProviderContract;
use WPIP\Packages\UnixTerminalOutput\Medium\UnixTerminalOutput;

use function DI\get;

final class UnixTerminalOutputPackage implements ProviderContract
{
    public function register(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addDefinitions([
            OutputPortContract::class => get(UnixTerminalOutput::class)
        ]);
    }
}
