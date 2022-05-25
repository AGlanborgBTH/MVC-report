<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

class Grouping
{
    public object $fallback;

    public function __construct()
    {
        $this->fallback = new Fallback;
    }

    public function result($player, $dealer): int
    {
        return $this->fallback->result($player->grouping->value, $dealer->grouping->value, [], [], 5);
    }
}