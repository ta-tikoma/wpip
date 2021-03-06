<?php

use WPIP\Packages\ANSI\ANSIPackage;
use WPIP\Packages\CommandMode\CommandModePackage;
use WPIP\Packages\Cursors\CursorsPackage;
use WPIP\Packages\CursorsMove\CursorsMovePackage;
use WPIP\Packages\Files\FilesPackage;
use WPIP\Packages\FileView\FileViewPackage;
use WPIP\Packages\UnixTerminalInput\UnixTerminalInputPackage;
use WPIP\Packages\UnixTerminalOutput\UnixTerminalOutputPackage;

return [
    ANSIPackage::class,
    UnixTerminalOutputPackage::class,
    UnixTerminalInputPackage::class,

    FilesPackage::class,
    FileViewPackage::class,

    CursorsPackage::class,
    CursorsMovePackage::class,

    CommandModePackage::class,
];
