<?php

namespace WPIP\Packages\FileView\Listeners;

use WPIP\Contracts\Listener\Event\EventContract;
use WPIP\Contracts\Listener\ListenerContract;
use WPIP\Contracts\Listener\Status\StatusContract;
use WPIP\Models\Screen\Screen;
use WPIP\Packages\Files\Contracts\FileRepositoryContract;
use WPIP\Packages\FileView\Services\FileViewService;

final class FileViewListener implements ListenerContract
{
    /**
     * @var FileRepositoryContract
     */
    private $fileRepository;

    /**
     * @var FileViewService
     */
    private $fileView;

    public function __construct(FileRepositoryContract $fileRepository, FileViewService $fileView)
    {
        $this->fileView = $fileView;
        $this->fileRepository = $fileRepository;
    }

    public function listen(EventContract $event, StatusContract $status, Screen $screen)
    {
        $this->fileView->view(
            $screen,
            $this->fileRepository->current()
        );
    }
}
