<?php

namespace WPIP\Packages\UnixTerminal;

use DI\Container;
use WPIP\Contracts\Medium\Event\EventContract;
use WPIP\Contracts\Medium\MediumContract;
use WPIP\Contracts\Package\PackageContract;
use WPIP\Models\Screen\Screen;
use WPIP\Packages\UnixTerminal\Medium\Terminal;
use WPIP\Packages\UnixTerminal\Medium\Unix;

use function DI\get;

final class UnixTerminalPackage implements PackageContract
{
    public function register(Container $container): void
    {
        $container->set(
            MediumContract::class,
            get(Unix::class)
        );

        $container->set(
            MediumContract::class,
            get(Terminal::class)
        );
    }

    public function listen(EventContract $event, Screen $screen): void
    {
    }
}
