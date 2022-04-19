<?php

namespace App\Card;

class Player
{
    public $hand = array();

    public function add_card($card): void
    {
        array_push($this->hand, $card);
    }

    public function clear_hand(): void
    {
        $this->hand = array();
    }
}
