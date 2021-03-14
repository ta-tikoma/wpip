<?php

namespace WPIP\Packages\Files\Listeners;

use WPIP\Contracts\Listener\Event\EventContract;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Listener\Status\StatusContract;
use WPIP\Models\Medium\Event\StartEvent;
use WPIP\Models\Screen\Screen;
use WPIP\Packages\Files\Contracts\FileRepositoryContract;
use WPIP\Packages\Files\Models\File;

final class FileListener implements ListenerContract
{
    /**
     * @var FileRepositoryContract
     */
    private $fileRepository;

    public function __construct(FileRepositoryContract $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function listen(EventContract $event, StatusContract $status, Screen $screen)
    {
        if ($event instanceof StartEvent) {
            if (isset($event->arguments[0])) {
                $this->fileRepository->add(new File($event->arguments[0]));
            }
        }
    }
}
