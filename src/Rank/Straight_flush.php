<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Rank;

class Straight_flush
{
    public object $ascending;

    public object $grouping;

    public function __construct($cards)
    {
        $this->ascending = new \App\Assert\Ascending();
        $this->grouping = new \App\Assert\Grouping();
        $this->assert_validity($cards);
    }

    protected function assert_validity($cards): void
    {
        $this->grouping->assert($cards, 5);
        $this->ascending->assert($cards, 5);
    }

    public function result(): bool
    {
        if (
            $this->grouping->bool and
            $this->ascending->bool
        ) {
            return true;
        }

        return false;
    }
}