<?php

/**
 * This file is a module containing the BJDeck class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Poker;

use App\Poker\PokerCard;
use App\Card\Deck;

/**
 * PokerDeck is an class made for playing virtual Poker as a part of the App\Poker\Poker class
 */
class PokerDeck extends Deck
{
    /**
     * Constructing method for the class
     *
     * The method uses other methods to create a poker deck and to then shuffle it
     */
    public function __construct()
    {
        $this->distributePatterns();
        $this->shuffle();
    }

    /**
     * Main method for creating a poker deck
     *
     * The method loops through an array of patterns and runs $this->distribute_values for every pattern,
     * creating an complete deck
     */
    protected function distributePatterns(): void
    {
        $patterns = array("D", "C", "H", "S");

        foreach ($patterns as $pattern) {
            $this->distributeValues($pattern);
        }
    }

    /**
     * Assisting method for creating a poker deck
     *
     * The method loops through an array of values to create and compelete deck of card objects, with
     * $this->distribute_patterns
     */
    protected function distributeValues($pattern): void
    {
        $values = array("A", 2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K");

        foreach ($values as $value) {
            array_push($this->ordered, new PokerCard($value, $pattern));
        }
    }
}
