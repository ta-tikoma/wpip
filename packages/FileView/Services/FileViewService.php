<?php

namespace WPIP\Packages\FileView\Services;

use WPIP\Models\Screen\Cell\Cell;
use WPIP\Models\Screen\Screen;
use WPIP\Packages\Files\Models\File;
use WPIP\Packages\FileView\Models\Screen\FileLayer;

final class FileViewService
{
    public function view(Screen $screen, File $file)
    {
        $layer = $screen->appendLayer(FileLayer::class);

        $lines = explode("\n", $file->content);

        $layer->do(function (Cell $cell, int $x, int $y) use ($lines) {
            if (!isset($lines[$y])) {
                return;
            }
            if (!isset($lines[$y][$x])) {
                return;
            }

            $cell->value = $lines[$y][$x];
        });
    }
}
