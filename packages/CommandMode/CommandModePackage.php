<?php

namespace packages\CommandMode;

use DI\Container;
use WPIP\CommandMode\Services\CommandModeService;
use WPIP\Contracts\Medium\Event\EventContract;
use WPIP\Contracts\Package\PackageContract;
use WPIP\Models\Package\ListenResult;
use WPIP\Models\Screen\Screen;

final class CommandModePackage implements PackageContract
{
    /**
     * @var CommandModeService
     */
    private $commandModeService;

    public function __construct(CommandModeService $commandModeService)
    {
        $this->commandModeService = $commandModeService;
    }

    public function register(Container $container): void
    {
    }

    public function listen(EventContract $event, ListenResult $result): ListenResult
    {
        return $this->commandModeService->listen($event, $result);
    }

    public function render(Screen $screen): void
    {
        $this->commandModeService->render($screen);
    }
}
