<?php

namespace WPIP\Packages\Files\Models;

final class File
{
    public $path;

    public $content;

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->content = file_get_contents($path);
    }
}
