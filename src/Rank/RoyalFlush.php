<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Rank;

/**
 * RoyalFlush is an class made asserting if an array of App\Poker\PokerCard consist of the highest valued cards
 * and all of the same group/pattern (a Royal Flush)
 */
class RoyalFlush
{
    /**
     * $grouping is an property containing an object for asserting if an array of App\Poker\PokerCard objects
     * contain cards of the same group/pattern
     *
     * @var object
     */
    public object $grouping;

    /**
     * $royal is an property containing an object for asserting if an array of App\Poker\PokerCard objects is royal
     *
     * @var object
     */
    public object $royal;

    /**
     * Constructing method for the class
     *
     * The method creates two objects App\Assert\Grouping and App\Assert\Royal
     *
     * Using both objects, the object will asses if the content conatin a royal flush
     *
     * @param array $cards an array of App\Poker\PokerCard objects; to be asorted if they contain a royal flush
     */
    public function __construct(array $cards)
    {
        $this->grouping = new \App\Assert\Grouping();
        $this->royal = new \App\Assert\Royal();
        $this->grouping->assert($cards, 5);
        $this->royal->assert($cards);
    }

    /**
     * Method for returning the result; if the content, entered into the constructing method, contain a royal flush
     */
    public function result(): bool
    {
        if (
            $this->grouping->bool and
            $this->royal->bool
        ) {
            return true;
        }

        return false;
    }
}
