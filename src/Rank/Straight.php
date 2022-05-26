<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Rank;

/**
 * Straight is an class made asserting if an array of App\Poker\PokerCard consist of 5 or more cards in an
 * ascending order (a Straight)
 */
class Straight
{
    /**
     * $ascending is an property containing an object for asserting if an array of App\Poker\PokerCard objects
     * contain a straight
     *
     * @var object
     */
    public object $ascending;

    /**
     * Constructing method for the class
     *
     * The method creates an object (App\Assert\Ascending) to asses if the content contain a straight
     *
     * @param array $cards an array of App\Poker\PokerCard objects; to be asorted if they contain a straight
     */
    public function __construct(array $cards)
    {
        $this->ascending = new \App\Assert\Ascending();
        $this->ascending->assert($cards, 5);
    }

    /**
     * Method for returning the result; if the content, entered into the constructing method, contain a straight
     */
    public function result(): bool
    {
        if (
            $this->ascending->bool
        ) {
            return true;
        }

        return false;
    }
}
