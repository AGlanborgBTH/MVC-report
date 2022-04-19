<?php

namespace App\Card;

use App\Card\Card;

class DeckWith2Jokers extends Deck
{
    public function __construct()
    {
        $this->insert();

        array_push($this->ordered, new Card("*", "J"));
        array_push($this->ordered, new Card("*", "J"));

        $this->shuffle();
    }
}
