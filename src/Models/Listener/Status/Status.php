<?php

namespace WPIP\Models\Listener\Status;

use WPIP\Contracts\Listener\Status\StatusContract;

final class Status implements StatusContract
{
    /**
     * @var string[]
     */
    private $keepers = [];

    public function has(string $keeper): bool
    {
        return in_array($keeper, $this->keepers);
    }

    public function add(string $keeper): void
    {
        $this->keepers[] = $keeper;
    }

    public function isEmpty(): bool
    {
        return count($this->keepers) == 0;
    }

    public function remove(string $keeper): void
    {
        if ($index = array_search($keeper, $this->keepers)) {
            unset($this->keepers[$index]);
        }
    }
}
