<?php

namespace WPIP\Contracts\Package;

use DI\Container;
use WPIP\Contracts\Medium\Event\EventContract;
use WPIP\Models\Screen\Screen;

interface PackageContract
{
    public function register(Container $container): void;

    public function listen(EventContract $event, Screen $screen): void;
}
