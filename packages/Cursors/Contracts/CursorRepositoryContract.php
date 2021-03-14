<?php

namespace WPIP\Packages\Cursors\Contracts;

use WPIP\Packages\Cursors\Models\Cursor;

interface CursorRepositoryContract
{
    public function add(Cursor $cursor);
    public function last(): Cursor;
    /**
     * @return Cursor[]
     */
    public function all(): array;
}
