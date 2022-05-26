<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Rank;

/**
 * Four is an class made asserting if an array of App\Poker\PokerCard consist of 3 of the same points/value value (a
 * Three of a kind)
 */
class Three
{
    /**
     * $matching is an property containing an object for asserting if an array of App\Poker\PokerCard objects contain
     * three of a kind
     *
     * @var object
     */
    public object $matching;

    /**
     * Constructing method for the class
     *
     * The method creates an object (App\Assert\Matching) to asses if the content contain three of a kind
     *
     * @param array $cards an array of App\Poker\PokerCard objects; to be asorted if they contain three of a kind
     */
    public function __construct($cards)
    {
        $this->matching = new \App\Assert\Matching();
        $this->matching->assert($cards, 3);
    }

    /**
     * Method for returning the result; if the content, entered into the constructing method, contain three of a kind
     */
    public function result(): bool
    {
        if (
            $this->matching->bool
        ) {
            return true;
        }

        return false;
    }
}
