<?php

namespace WPIP;

use DI\Container;
use DI\ContainerBuilder;
use WPIP\Contracts\Listener\Event\EventContract;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Medium\InputProvider;
use WPIP\Contracts\Medium\OutputPortContract;
use WPIP\Contracts\Package\PackageContract;
use WPIP\Models\Listener\Status\Status;
use WPIP\Models\Medium\Event\StartEvent;
use WPIP\Models\Screen\Screen;

final class WPIP
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(string $packages, string $defaultPackages)
    {
        if (file_exists($packages)) {
            $packages = require $packages;
        } else {
            $packages = require $defaultPackages;
        }

        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions([
            ListenerContract::LISTENER_CONTAINER_LIST => []
        ]);

        foreach ($packages as $packageClass) {
            /** @var PackageContract $package */
            $package = new $packageClass();
            $package->register($containerBuilder);
        }

        $this->container = $containerBuilder->build();
    }

    public function run()
    {
        /** @var OutputPortContract $outputPort */
        $outputPort = $this->container->get(OutputPortContract::class);
        /** @var InputProvider $inputProvider */
        $inputProvider = $this->container->get(InputProvider::class);

        $screen = new Screen();
        $status = new Status();

        $this->sendEvent($outputPort, $screen, new StartEvent(), $status);

        while (true) {
            $event = $inputProvider->event();
            $this->sendEvent($outputPort, $screen, $event, $status);
        }
    }

    private function sendEvent(
        OutputPortContract $outputPort,
        Screen $screen,
        EventContract $event,
        Status $status
    ) {
        $screen->size = $outputPort->getSize();

        /** @var ListenerContract[] $listeners */
        $listeners = $this->container->get(ListenerContract::LISTENER_CONTAINER_LIST);

        foreach ($listeners as $listener) {
            $listener->listen($event, $status, $screen);
        }

        $outputPort->render($screen);
    }
}
