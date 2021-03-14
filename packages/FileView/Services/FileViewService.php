<?php

namespace WPIP\Packages\FileView\Services;

use WPIP\Models\Screen\Cell\Cell;
use WPIP\Models\Screen\Screen;
use WPIP\Packages\FileView\Models\Screen\FileLayer;

final class FileViewService
{
    public function view(Screen $screen, string $path)
    {
        $layer = $screen->appendLayer(FileLayer::class);

        $fileContent = file_get_contents($path);
        $lines = explode("\n", $fileContent);
        // $lines = array_map(function ($line) {
        //     return $line . "\n";
        // }, $lines);

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
