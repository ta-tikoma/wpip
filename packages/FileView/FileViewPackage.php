<?php

namespace WPIP\Packages\FileView;

use DI\Container;
use WPIP\Contracts\Medium\Event\EventContract;
use WPIP\Contracts\Medium\Event\StartEvent;
use WPIP\Contracts\Package\PackageContract;
use WPIP\Models\Screen\Screen;
use WPIP\Packages\FileView\Services\FileViewService;

final class FileViewPackage implements PackageContract
{
    /**
     * @var FileViewService
     */
    private $fileView;

    private $file;

    public function __construct(FileViewService $fileView)
    {
        $this->fileView = $fileView;
    }

    public function register(Container $container): void
    {
    }

    public function listen(EventContract $event, Screen $screen): void
    {
        if ($event instanceof StartEvent) {
            if (isset($event->arguments[0])) {
                $this->file = $event->arguments[0];
            }
        }

        $this->fileView->view($screen, $this->file);
    }
}
