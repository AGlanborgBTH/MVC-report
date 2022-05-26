<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

/**
 * Ascending is an class made for asserting wish of two App\Assert\Ascending objects contain the highest value
 */
class Ascending
{
    /**
     * Method for returning the result; wich of the App\Assert\Ascending objects contain the highest value
     *
     * Method is based on the App\Assert\Ascending class results
     *
     * @param object $player the first of the App\Assert\Ascending objects to be compared
     *
     * @param object $dealer the second of the App\Assert\Ascending objects to be compared
     */
    public function result(object $player, object $dealer): int
    {
        $player_high = 0;

        foreach ($player->ascending->value as $points) {
            if ($points > $player_high) {
                $player_high = $points;
            }
        }

        $dealerHigh = 0;

        foreach ($dealer->ascending->value as $points) {
            if ($points > $dealerHigh) {
                $dealerHigh = $points;
            }
        }

        if ($player_high > $dealerHigh) {
            return 6;
        } elseif ($player_high == $dealerHigh) {
            return 5;
        } else {
            return 4;
        }
    }
}
