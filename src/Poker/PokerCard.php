<?php

/**
 * This file is a module containing the BJCard class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Poker;

use App\Card\Card;

/**
 * PokerCard is an class made for playing virtual Poker as a part of the App\Poker\Poker class
 */
class PokerCard extends Card
{
    /**
     * The $points property represents the amount of points the card object is worth in the Poker game
     *
     * @var int
     */
    protected int $points;

    /**
     * The $color property represents the color of the card object
     *
     * @var string
     */
    protected string $color;

    /**
     * Constructing method for the class
     *
     * The method uses other methods to define value, points, pattern and color
     *
     * @param mixed $value is the value dictating the value and points of the card
     *
     * @param string $value is the value dictating the pattern and color of the card
     */
    public function __construct(mixed $value, string $pattern)
    {
        $this->defineValue($value);
        $this->definePattern($pattern);
    }

    /**
     * Method for defining/assigning pattern- and color-value to each respective property
     */
    protected function definePattern(string $pattern): void
    {
        $this->pattern = $pattern;

        if ($pattern == "D" or $pattern == "H") {
            $this->color = "red";
        } else {
            $this->color = "black";
        }
    }

    /**
     * Method for defining/assigning value- and points-value to each respective property
     */
    protected function defineValue(mixed $value): void
    {
        $this->value = $value;

        if (is_string($value)) {
            $this->definePoints($value);
        } else {
            $this->points = $value;
        }
    }

    /**
     * Method is for defining points if an string value was entered in the _constructing method
     */
    protected function definePoints(string $value): void
    {
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

    /**
     * Get-method for returning the protected $color property
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Get-method for returning the protected $points property
     */
    public function getPoints(): int
    {
        return $this->points;
    }
}
