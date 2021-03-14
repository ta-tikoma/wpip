<?php

namespace WPIP\Models\Keyboard;

final class Key
{
    /**
     * @var string
     */
    private $key;

    private function __construct(string $key)
    {
        $this->key = $key;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function equal(self $keyboard): bool
    {
        return $this->getKey() === $keyboard->getKey();
    }

    public static function fromInput(string $key)
    {
        return new self($key);
    }

    public static function colon(): self
    {
        return new self(':');
    }

    public static function j(): self
    {
        return new self('j');
    }

    public static function k(): self
    {
        return new self('k');
    }

    public static function h(): self
    {
        return new self('h');
    }

    public static function l(): self
    {
        return new self('l');
    }
}
