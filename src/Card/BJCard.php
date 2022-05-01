<?php

/**
 * This file is a module containing the BJCard class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Card;

use App\Card\Card;

/**
 * The BJCard is an extendtion of the App\Card\Card class
 * that contains extra methods and properties, specificly
 * for Black Jack (BJ) games
 */
class BJCard extends Card
{
    /**
     * Value property for holding the point-value of the card object
     *
     * @var int
     */
    protected int $points;

    /**
     * Constructing method for the class
     *
     * Assigns the $value- and $pattern-property with the parameter-values given
     *
     * @param mixed     $val Parameter dictating the value of the card object
     * @param string    $pat Parameter dictating the pattern of the card object
     */
    public function __construct(mixed $val, string $pat)
    {
        $this->value = $val;
        $this->pattern = $pat;
        $this->set_points();
    }

    /**
     * Set-method for changing the protected $points property
     *
     * The value of the points is dependent on the rules of the BJ game
     *
     * This method follows the rules of BJ and sets the points depending
     * on that factor
     */
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

    /**
     * Get-method for returning the protected $points property
     */
    public function get_points(): int
    {
        return $this->points;
    }

    /**
     * Method for reducing the value of the card if it is an ace (valued "A")
     *
     * The value of the points is dependent on the rules of the BJ game
     *
     * This method follows the rules of BJ and sets the points depending
     * on that factor
     */
    public function reduce_a(): void
    {
        if ($this->value == "A") {
            $this->points = 1;
        }
    }
}
