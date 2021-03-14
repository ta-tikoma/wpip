<?php

namespace WPIP\Packages\FileView\Listeners;

use WPIP\Contracts\Listener\Event\EventContract;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Listener\Status\StatusContract;
use WPIP\Models\Medium\Event\StartEvent;
use WPIP\Models\Screen\Screen;
use WPIP\Packages\FileView\Services\FileViewService;

final class FileViewListener implements ListenerContract
{
    private $file;

    /**
     * @var FileViewService
     */
    private $fileView;

    public function __construct(FileViewService $fileView)
    {
        $this->fileView = $fileView;
    }

    public function listen(EventContract $event, StatusContract $status, Screen $screen)
    {
        if ($event instanceof StartEvent) {
            if (isset($event->arguments[0])) {
                $this->file = $event->arguments[0];
            }
        }

        $this->fileView->view($screen, $this->file);
    }
}
