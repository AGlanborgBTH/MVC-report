<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

class Matching
{
    public function result($player, $dealer): int
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