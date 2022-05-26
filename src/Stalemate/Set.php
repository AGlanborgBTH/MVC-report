<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

/**
 * Set is an class made for asserting wish of two App\Assert\Set objects contain the highest value
 */
class Set
{
    /**
     * Method for returning the result; wich of the arrays of App\Assert\Set objects contain the highest value
     *
     * Method is based on the App\Assert\Set class results
     *
     * @param object $player the first of the App\Assert\Set objects to be compared
     *
     * @param object $dealer the second of the App\Assert\Set objects to be compared
     */
    public function result($player, $dealer): int
    {
        if ($player->set->value[0] > $dealer->set->value[0]) {
            return 6;
        } elseif ($player->set->value[0] == $dealer->set->value[0]) {
            return $this->identify($player, $dealer);
        } elseif ($player->set->value[0] < $dealer->set->value[0]) {
            return 4;
        }
    }

    public function identify($player, $dealer): int
    {
        if ($player->set->value[1] > $dealer->set->value[1]) {
            return 6;
        } elseif ($player->set->value[1] == $dealer->set->value[1]) {
            return 5;
        } elseif ($player->set->value[1] < $dealer->set->value[1]) {
            return 4;
        }
    }
}
