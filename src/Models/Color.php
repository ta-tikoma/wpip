<?php

namespace WPIP\Models;

final class Color
{
    private const GREEN = 'GREEN';

    /**
     * @var string
     */
    private $color;

    private function __construct(string $color)
    {
        $this->color = $color;
    }

    public function __toString()
    {
        return $this->color;
    }

    public static function green()
    {
        return new self(self::GREEN);
    }
}
