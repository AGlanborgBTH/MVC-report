<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Rank;

class High_card
{
    public object $card;

    public function __construct($cards)
    {
        $this->set = new \App\Assert\Set();
        $this->get_highcard($cards);
    }

    public function get_highcard($cards)
    {
        $final = [];

        foreach($cards as $card) {
            $points = $card->get_points();
            
            if ($points == 1) {
                $final[0] = $card;
                break;
            } elseif (count($final) == 0 or $points > $final[0]->get_points()) {
                $final[0] = $card;
            }
        }

        $this->card = $final[0];
    }
}