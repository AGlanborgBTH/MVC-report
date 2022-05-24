<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Rank;

class Straight
{
    public string $result;

    public object $ascending;

    public function __construct($cards)
    {
        $this->ascending = new \App\Assert\Ascending();
        $this->ascending->assert($cards, 5);
    }

    public function result(): bool
    {
        if (
            $this->ascending->bool
        ) {
            return true;
        }

        return false;
    }
}