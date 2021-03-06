<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

/**
 * High is an class made for asserting wish of two arrays of App\Poker\PokerCard objects contain the highest
 * valued cards
 */
class High
{
    /**
     * Method for returning the result; wich of the arrays of App\Poker\PokerCard objects contain the highest
     * valued cards
     *
     * @param array $player the first of the arrays containing App\Poker\PokerCard objects to be compared
     *
     * @param array $dealer the second of the arrays containing App\Poker\PokerCard objects to be compared
     */
    public function result(array $player, array $dealer): int
    {
        $player_high = 0;

        foreach ($player as $card) {
            if ($card->getPoints() > $player_high) {
                $player_high = $card->getPoints();
            }
        }

        $dealerHigh = 0;

        foreach ($dealer as $card) {
            if ($card->getPoints() > $dealerHigh) {
                $dealerHigh = $card->getPoints();
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
