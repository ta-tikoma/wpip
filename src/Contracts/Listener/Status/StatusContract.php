<?php

namespace WPIP\Contracts\Listener\Status;

interface StatusContract
{
    public function add(string $keeper);
    public function remove(string $keeper);
    public function has(string $keeper): bool;
    public function isEmpty(): bool;
}
