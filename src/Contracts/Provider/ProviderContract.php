<?php

namespace WPIP\Contracts\Provider;

use DI\ContainerBuilder;

interface ProviderContract
{
    public function register(ContainerBuilder $containerBuilder): void;
}
