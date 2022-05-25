<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

class Four
{
    public object $matching;

    public object $fallback;

    public function __construct()
    {
        $this->matching = new Matching;
        $this->fallback = new Fallback;
    }

    public function result($player, $dealer, $player_hand, $dealer_hand, $table_hand): int
    {
        $matching = $this->matching->result($player, $dealer);

        if ($matching == 5) {
            return $this->fallback->result($player_hand, $dealer_hand, $table_hand, $player->matching->value, 1);
        } else {
            return $matching;
        }
    }
}