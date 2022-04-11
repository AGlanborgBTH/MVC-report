<?php

namespace App\Card;

class Card
{
    protected $value;
    protected $pattern;

    public function __construct($val, $pat)
    {
        $this->value = $val;
        $this->pattern = $pat;
    }

    public function get_value(): string
    {
        return $this->value;
    }

    public function get_pattern(): string
    {
        return $this->pattern;
    }
}
