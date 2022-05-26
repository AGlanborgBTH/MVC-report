<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Rank;

/**
 * Pair is an class made asserting if an array of App\Poker\PokerCard consist of 2 or more of the same points/value
 * (a Pair)
 */
class Pair
{
    /**
     * $matching is an property containing an object for asserting if an array of App\Poker\PokerCard objects contain a
     * pair
     *
     * @var object
     */
    public object $matching;

    /**
     * Constructing method for the class
     *
     * The method creates an object (App\Assert\Matching) to asses if the content contain a pair
     *
     * @param array $cards an array of App\Poker\PokerCard objects; to be asorted if they contain a pair
     */
    public function __construct(array $cards)
    {
        $this->matching = new \App\Assert\Matching();
        $this->matching->assert($cards, 2);
    }

    /**
     * Method for returning the result; if the content, entered into the constructing method, contain a pair
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
