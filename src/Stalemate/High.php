<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

class High
{
    public function result($player, $dealer): int
    {
        $player_high = 0;

        foreach($player as $card) {
            if ($card->get_points() > $player_high) {
                $player_high = $card->get_points();
            }
        }

        $dealer_high = 0;

        foreach($dealer as $card) {
            if ($card->get_points() > $dealer_high) {
                $dealer_high = $card->get_points();
            }
        }

        if ($player_high > $dealer_high) {
            return 6;
        } elseif ($player_high == $dealer_high) {
            return 5;
        } else {
            return 4;
        }
    }
}