<?php

namespace App\Card;

use App\Card\Card;

class BJCard extends Card
{
    protected $points;

    public function __construct($val, $pat)
    {
        $this->value = $val;
        $this->pattern = $pat;
        $this->set_points();
    }

    protected function set_points(): void
    {
        $value = $this->value;

        if ($value == "A") {
            $this->points = 11;
        } elseif ($value == "J" or $value == "Q" or $value == "K") {
            $this->points = 10;
        } else {
            $this->points = (int) $this->get_value();
        }
    }

    public function get_points(): int
    {
        return $this->points;
    }

    public function reduce_a(): void
    {
        if ($this->value == "A") {
            $this->points = 1;
        }
    }
}
