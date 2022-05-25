<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

class Ascending
{
    public function result(object $player, object $dealer): int
    {
        $player_high = 0;

        foreach($player->ascending->value as $points) {
            if ($points > $player_high) {
                $player_high = $points;
            }
        }

        $dealer_high = 0;

        foreach($dealer->ascending->value as $points) {
            if ($points > $dealer_high) {
                $dealer_high = $points;
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