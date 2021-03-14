<?php

namespace WPIP\Packages\Cursors\Repositories;

use WPIP\Packages\Cursors\Contracts\CursorRepositoryContract;
use WPIP\Packages\Cursors\Models\Cursor;

final class CursorRepository implements CursorRepositoryContract
{
    /**
     * @var Cursor[]
     */
    private $storage = [];

    public function __construct()
    {
        $this->storage[] = new Cursor();
    }

    public function add(Cursor $cursor)
    {
        $this->storage[] = $cursor;
    }

    public function last(): Cursor
    {
        return $this->storage[count($this->storage) - 1];
    }

    public function all(): array
    {
        return $this->storage;
    }
}
