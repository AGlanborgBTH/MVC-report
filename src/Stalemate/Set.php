<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

class Set
{
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