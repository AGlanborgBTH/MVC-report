<?php

/**
 * This file is a module containing the BJDeck class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Poker;

use App\Poker\PokerCard;
use App\Card\Deck;

class PokerDeck extends Deck
{
    public function __construct()
    {
        $this->distribute_patterns();
        $this->shuffle();
    }

    protected function distribute_patterns(): void
    {
        $patterns = array("D", "C", "H", "S");

        foreach ($patterns as $pattern) {
            $this->distribute_values($pattern);
        }
    }

    protected function distribute_values($pattern): void
    {
        $values = array("A", 2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K");

        foreach ($values as $value) {
            array_push($this->ordered, new PokerCard($value, $pattern));
        }
    }
}