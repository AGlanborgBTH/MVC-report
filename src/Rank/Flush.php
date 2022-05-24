<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Rank;

class Flush
{
    public object $grouping;

    public function __construct($cards)
    {
        $this->grouping = new \App\Assert\Grouping();
        $this->grouping->assert($cards, 5);
    }

    public function result(): bool
    {
        if (
            $this->grouping->bool
        ) {
            return true;
        }

        return false;
    }
}