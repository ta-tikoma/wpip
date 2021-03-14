<?php

namespace WPIP\Packages\Files\Contracts;

use WPIP\Packages\Files\Models\File;

interface FileRepositoryContract
{
    public function add(File $file);
    /**
     * @return File[]
     */
    public function all(): array;

    public function current(): File;
}
