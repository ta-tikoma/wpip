<?php

namespace WPIP\Packages\Files\Repositories;

use WPIP\Packages\Files\Contracts\FileRepositoryContract;
use WPIP\Packages\Files\Models\File;

final class FileRepository implements FileRepositoryContract
{
    private $storage = [];

    public function add(File $file)
    {
        $this->storage[] = $file;
    }

    public function all(): array
    {
        return $this->storage;
    }

    public function current(): File
    {
        return $this->storage[count($this->storage) - 1];
    }
}
