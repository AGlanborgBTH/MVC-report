<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Rank;

class Full_house
{
    public object $set;

    public function __construct($cards)
    {
        $this->set = new \App\Assert\Set();
        $this->set->assert($cards, 3, 2);
    }

    public function result(): bool
    {
        if (
            $this->set->bool
        ) {
            return true;
        }

        return false;
    }
}