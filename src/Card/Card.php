<?php

/**
 * This file is a module containing the Card class
 * 
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Card;

/**
 * The Card is an class made for games and simple functions
 * on the report web-page
 */
class Card
{
    /**
     * Value property for holding the value of the card object
     * 
     * @var string|int
     */
    protected mixed $value;
    /**
     * Value property for holding the pattern of the card object
     * 
     * @var string
     */
    protected string $pattern;

    /**
     * Constructing method for the class
     * 
     * Assigns the $value- and $pattern-property with the parameter-values given
     * 
     * @param string|int     $val Parameter dictating the value of the card object
     * @param string    $pat Parameter dictating the pattern of the card object
     */
    public function __construct(mixed $val, string $pat)
    {
        $this->value = $val;
        $this->pattern = $pat;
    }

    /**
     * Get-method for returning the protected $value property
     */
    public function get_value(): string
    {
        return $this->value;
    }

    /**
     * Get-method for returning the protected $pattern property
     */
    public function get_pattern(): string
    {
        return $this->pattern;
    }
}
