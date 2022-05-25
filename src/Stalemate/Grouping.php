<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

/**
 * Grouping is an class made for asserting wish of two App\Assert\Grouping objects contain the highest value
 */
class Grouping
{
    /**
     * $fallback is an object used for asserting wish of two App\Assert\Grouping objects contain the highest value
     */
    public object $fallback;

    /**
     * Constructing method for the class
     * 
     * Assigns the $this->fallback value of the class with an App\Stalemate\Fallback object
     */
    public function __construct()
    {
        $this->fallback = new Fallback;
    }

    /**
     * Method for returning the result; wich of the App\Assert\Grouping objects contain the highest value
     * 
     * @param object $player the first of two App\Poker\PokerHandRank objects to be compared
     * 
     * @param object $dealer the second of two App\Poker\PokerHandRank objects to be compared
     */
    public function result(object $player, object $dealer): int
    {
        return $this->fallback->result($player->grouping->value, $dealer->grouping->value, [], [], 5);
    }
}