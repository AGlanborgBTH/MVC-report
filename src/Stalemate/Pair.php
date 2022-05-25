<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

/**
 * Pair is an class made for asserting wish of two 'characters' contain the highest valued cards
 */
class Pair
{
    /**
     * $matching is an object used for asserting wish of two App\Assert\Matching objects contain the highest value
     */
    public object $matching;

    /**
     * $fallback is an object used for asserting wish of two arrays of App\Poker\PokerCard objects contain the highest valued cards
     */
    public object $fallback;

    /**
     * Constructing method for the class
     *
     * Assigns the $this->matching value of the class with an App\Stalemate\Matching object
     * 
     * Assigns the $this->fallback value of the class with an App\Stalemate\Fallback object
     */
    public function __construct()
    {
        $this->matching = new Matching;
        $this->fallback = new Fallback;
    }

    /**
     * Method for returning the result; wich of the 'characters' contain the highest valued cards
     * 
     * @param object $player the first of two App\Poker\PokerHandRank objects to be compared
     * 
     * @param object $dealer the second of two App\Poker\PokerHandRank objects to be compared
     * 
     * @param array $player_hand the first of the arrays to be compared
     * 
     * @param array $dealer_hand the second of the arrays to be compared
     * 
     * @param array $table_hand an array containing cards; shared among $player and $dealer
     */
    public function result($player, $dealer, $player_hand, $dealer_hand, $table_hand): int
    {
        $asc = $this->matching->result($player, $dealer);

        if ($asc == 5) {
            return $this->fallback->result($player_hand, $dealer_hand, $table_hand, $player->matching->value, 3);
        } else {
            return $asc;
        }
    }
}