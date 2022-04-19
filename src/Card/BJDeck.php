<?php

namespace App\Card;

use App\Card\BJCard;

class BJDeck extends Deck
{
    public function __construct()
    {
        $this->bj_insert();
        $this->shuffle();
    }

    protected function bj_insert(): void
    {
        $patterns = array("D", "C", "H", "S");
        $values = array("A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K");

        foreach ($patterns as $pattern) {
            foreach ($values as $value) {
                array_push($this->ordered, new BJCard($value, $pattern));
            }
        }
    }
}
