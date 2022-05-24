<?php

/**
 * This file is a module containing the BJCard class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Poker;

class PokerPlayer
{
    public array $hand = array();

    public array $hand_rank;

    public function __construct(array $hand = null)
    {
        if($hand) {
            $this->hand = $hand;
        }
    }

    public function add_card($card): void
    {
        array_push($this->hand, $card);
    }

    public function remove_cards(): void
    {
        $this->hand = [];
    }
}