<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

/**
 * Matching is an class made for asserting wish of two App\Assert\Matching objects contain the highest value
 */
class Matching
{
    /**
     * Method for returning the result; wich of App\Assert\Matching objects contain the highest value
     * 
     * @param object $player the first of the App\Assert\Matching objects to be compared
     * 
     * @param object $dealer the second of the App\Assert\Matching objects to be compared
     */
    public function result(object $player, object $dealer): int
    {
        if ($player->matching->value > $dealer->matching->value) {
            return 6;
        } elseif ($player->matching->value == $dealer->matching->value) {
            return 5;
        } else {
            return 4;
        }
    }
}