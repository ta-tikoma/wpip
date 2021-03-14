<?php

namespace WPIP\Models\Keyboard;

final class Key
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var int
     */
    private $code;

    private function __construct(string $key = null, int $code = null)
    {
        if (is_null($key) && !is_null($code)) {
            $this->key = chr($code);
            $this->code = $code;
        }
        if (is_null($code) && !is_null($key)) {
            $this->key = $key;
            $this->code = ord($key);
        }
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function equal(self $keyboard): bool
    {
        return $this->getCode() === $keyboard->getCode();
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

    public static function q(): self
    {
        return new self('q');
    }

    public static function space(): self
    {
        return new self(' ');
    }

    public static function less(): self
    {
        return new self('<');
    }

    public static function more(): self
    {
        return new self('>');
    }

    public static function esc(): self
    {
        return new self(null, 27);
    }

    public static function enter(): self
    {
        return new self(null, 10);
    }

    public static function backspace(): self
    {
        return new self(null, 127);
    }
}
