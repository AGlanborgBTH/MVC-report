<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

class Two
{
    public object $set;

    public object $fallback;

    public function __construct()
    {
        $this->set = new set;
        $this->fallback = new Fallback;
    }

    public function result($player, $dealer, $player_hand, $dealer_hand, $table_hand): int
    {
        $asc = $this->set->result($player, $dealer);

        if ($asc == 5) {
            return $this->fallback->result($player_hand, $dealer_hand, $table_hand, $player->set->value, 1);
        } else {
            return $asc;
        }
    }
}