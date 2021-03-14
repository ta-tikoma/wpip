<?php

namespace WPIP;

use DI\Container;
use DI\ContainerBuilder;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Medium\InputProvider;
use WPIP\Contracts\Medium\OutputPortContract;
use WPIP\Contracts\Package\PackageContract;
use WPIP\Contracts\WPIPContract;
use WPIP\Models\Listener\Status\Status;
use WPIP\Models\Screen\Screen;

abstract class WPIPLoader implements WPIPContract
{
    /**
     * @var OutputPortContract
     */
    protected $outputPort;

    /** 
     * @var InputProvider 
     */
    protected $inputProvider;

    /**
     * @var Screen
     */
    protected $screen;

    /**
     * @var Status
     */
    protected $status;

    /**
     * @var ListenerContract[]
     */
    protected $listeners;

    public function __construct(string $packages, string $defaultPackages)
    {
        $container = $this->load($packages, $defaultPackages);
        $this->init($container);
    }

    private function load(string $packages, string $defaultPackages): Container
    {
        if (file_exists($packages)) {
            $packages = require $packages;
        } else {
            $packages = require $defaultPackages;
        }

        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions([
            WPIPContract::class => $this,
            ListenerContract::LISTENER_CONTAINER_LIST => [],
        ]);

        foreach ($packages as $packageClass) {
            /** @var PackageContract $package */
            $package = new $packageClass();
            $package->register($containerBuilder);
        }

        return $containerBuilder->build();
    }

    private function init(Container $container)
    {
        $this->screen = new Screen();
        $this->status = new Status();

        $this->outputPort = $container->get(OutputPortContract::class);
        $this->inputProvider = $container->get(InputProvider::class);
        $this->listeners = $container->get(ListenerContract::LISTENER_CONTAINER_LIST);
    }
}
