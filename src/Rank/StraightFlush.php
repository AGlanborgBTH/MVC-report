<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Rank;

/**
 * StraightFlush is an class made asserting if an array of App\Poker\PokerCard consist of 5 or more cards in
 * an ascending order and all of the same group/pattern (a Straight Flush)
 */
class StraightFlush
{
    /**
     * $ascending is an property containing an object for asserting if an array of App\Poker\PokerCard objects
     * contain a in an ascending order
     *
     * @var object
     */
    public object $ascending;

    /**
     * $grouping is an property containing an object for asserting if an array of App\Poker\PokerCard objects
     * contain cards of the same group/pattern
     *
     * @var object
     */
    public object $grouping;

    /**
     * Constructing method for the class
     *
     * The method creates two objects App\Assert\Ascending and App\Assert\Grouping
     *
     * Using both objects, the object will asses if the content conatin a straight flush
     *
     * @param array $cards an array of App\Poker\PokerCard objects; to be asorted if they contain a straight flush
     */
    public function __construct(array $cards)
    {
        $this->ascending = new \App\Assert\Ascending();
        $this->grouping = new \App\Assert\Grouping();
        $this->grouping->assert($cards, 5);
        $this->ascending->assert($cards, 5);
    }

    /**
     * Method for returning the result; if the content, entered into the constructing method, contain a straight flush
     */
    public function result(): bool
    {
        if (
            $this->grouping->bool and
            $this->ascending->bool
        ) {
            return true;
        }

        return false;
    }
}
