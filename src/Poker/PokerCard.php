<?php

/**
 * This file is a module containing the BJCard class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Poker;

use App\Card\Card;

/**
 * The BJCard is an extendtion of the App\Card\Card class
 * that contains extra methods and properties, specificly
 * for Black Jack (BJ) games
 */
class PokerCard extends Card
{
    protected int $points;

    protected string $color;

    public function __construct(mixed $value, string $pattern)
    {
        $this->define_value($value);
        $this->define_pattern($pattern);
    }

    protected function define_pattern($pattern) {
        $this->pattern = $pattern;

        if ($pattern == "D" or $pattern == "H") {
            $this->color = "red";
        } else {
            $this->color = "black";
        }
    }

    protected function define_value($value) {
        $this->value = $value;

        if (is_string($value)) {
            $this->define_points($value);
        } else {
            $this->points = $value;
        }
    }

    protected function define_points($value) {
        if ($value == "A") {
            $this->points = 14;
        } elseif ($value == "K") {
            $this->points = 13;
        } elseif ($value == "Q") {
            $this->points = 12;
        } else {
            $this->points = 11;
        }
    }

    public function get_color(): string
    {
        return $this->color;
    }

    public function get_points(): int
    {
        return $this->points;
    }
}