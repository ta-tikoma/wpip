<?php

namespace WPIP\Packages\Files;

use DI\ContainerBuilder;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Provider\ProviderContract;
use WPIP\Packages\Files\Contracts\FileRepositoryContract;
use WPIP\Packages\Files\Listeners\FileListener;
use WPIP\Packages\Files\Repositories\FileRepository;

use function DI\add;
use function DI\get;

final class FilesPackage implements ProviderContract
{
    public function register(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addDefinitions([
            ListenerContract::LISTENER_CONTAINER_LIST => add(get(FileListener::class)),
            FileRepositoryContract::class => get(FileRepository::class)
        ]);
    }
}
