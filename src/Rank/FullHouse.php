<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Rank;

/**
 * FullHouse is an class made asserting if an array of App\Poker\PokerCard consist of 3 of the same points/value value and another 2 of the same points/value (a Full House)
 */
class FullHouse
{
    /**
     * $set is an property containing an object for asserting if an array of App\Poker\PokerCard objects contain a full house
     *
     * @var object
     */
    public object $set;

    /**
     * Constructing method for the class
     *
     * The method creates an object (App\Assert\Set) to asses if the content contain a full house
     * 
     * @param array $cards an array of App\Poker\PokerCard objects; to be asorted if they contain a full house
     */
    public function __construct(array $cards)
    {
        $this->set = new \App\Assert\Set();
        $this->set->assert($cards, 3, 2);
    }

    /**
     * Method for returning the result; if the content, entered into the constructing method, contain a full house
     */
    public function result(): bool
    {
        if (
            $this->set->bool
        ) {
            return true;
        }

        return false;
    }
}