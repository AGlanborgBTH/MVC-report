<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Rank;

class Four
{
    public object $matching;

    public function __construct($cards)
    {
        $this->matching = new \App\Assert\Matching();
        $this->matching->assert($cards, 4);
    }

    public function result(): bool
    {
        if (
            $this->matching->bool
        ) {
            return true;
        }

        return false;
    }
}