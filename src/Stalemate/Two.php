<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

/**
 * Two is an class made for asserting wish of two 'characters' contain the highest valued cards
 */
class Two
{
    /**
     * $set is an object used for asserting wish of two App\Assert\Set objects contain the highest value
     */
    public object $set;

    /**
     * $fallback is an object used for asserting wish of two arrays of App\Poker\PokerCard objects contain the highest valued cards
     */
    public object $fallback;

    /**
     * Constructing method for the class
     *
     * Assigns the $this->set value of the class with an App\Stalemate\Set object
     * 
     * Assigns the $this->fallback value of the class with an App\Stalemate\Fallback object
     */
    public function __construct()
    {
        $this->set = new set;
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
    public function result(object $player, object $dealer, array $player_hand, array $dealer_hand, array $table_hand): int
    {
        $asc = $this->set->result($player, $dealer);

        if ($asc == 5) {
            return $this->fallback->result($player_hand, $dealer_hand, $table_hand, $player->set->value, 1);
        } else {
            return $asc;
        }
    }
}