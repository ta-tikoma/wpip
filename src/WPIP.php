<?php

namespace WPIP;

use DI\Container;
use WPIP\Contracts\Medium\Event\EventContract;
use WPIP\Contracts\Medium\Event\StartEvent;
use WPIP\Contracts\Medium\MediumContract;
use WPIP\Contracts\Package\PackageContract;
use WPIP\Models\Screen\Screen;

final class WPIP
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var PackageContract[]
     */
    private $packages;

    public function __construct(string $packages, string $defaultPackages)
    {
        $container = new Container();

        if (file_exists($packages)) {
            $packages = require $packages;
        } else {
            $packages = require $defaultPackages;
        }

        foreach ($packages as $packageClass) {
            /** @var PackageContract $package */
            $package = $container->get($packageClass);
            $package->register($container);
            $this->packages[] = $package;
        }

        $this->container = $container;
    }

    public function run()
    {
        /** @var MediumContract $medium */
        $medium = $this->container->get(MediumContract::class);

        $screen = new Screen();

        $this->sendEvent($medium, $screen, new StartEvent());

        while (true) {
            $event = $medium->event();
            $this->sendEvent($medium, $screen, $event);
        }
    }

    private function sendEvent(
        MediumContract $medium,
        Screen $screen,
        EventContract $event
    ): void {
        $screen->width = $medium->getWidth();
        $screen->height = $medium->getHeight();

        foreach ($this->packages as $package) {
            $package->listen($event, $screen);
        }

        $medium->render($screen);
    }
}
