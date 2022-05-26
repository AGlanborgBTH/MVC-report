<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Rank;

/**
 * Flush is an class made asserting if an array of App\Poker\PokerCard consist of 5 or more cards that are of the same
 * group/pattern (a flush)
 */
class Flush
{
    /**
     * $grouping is an property containing an object for asserting if an array of App\Poker\PokerCard objects contain a
     * flush
     *
     * @var object
     */
    public object $grouping;

    /**
     * Constructing method for the class
     *
     * The method creates an object (App\Assert\Grouping) to asses if the content contain a flush
     *
     * @param array $cards an array of App\Poker\PokerCard objects; to be asorted if they contain a flush
     */
    public function __construct(array $cards)
    {
        $this->grouping = new \App\Assert\Grouping();
        $this->grouping->assert($cards, 5);
    }

    /**
     * Method for returning the result; if the content, entered into the constructing method, contain a flush
     */
    public function result(): bool
    {
        if (
            $this->grouping->bool
        ) {
            return true;
        }

        return false;
    }
}
