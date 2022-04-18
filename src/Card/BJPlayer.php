<?php

namespace App\Card;

class BJPlayer extends Player
{
    protected $state;
    // state 0 == lost
    // state 1 == playing
    // state 2 == hold
    // state 3 == won
    // state 4 == won x2
    protected $points;

    public function __construct()
    {
        $this->state = 1;
        $this->points = 0;
        $this->set_points();
    }

    public function get_state()
    {
        return $this->state;
    }

    public function set_state($num)
    {
        $this->state = $num;
    }

    public function get_points()
    {
        return $this->points;
    }

    public function set_points()
    {
        $this->points = 0;

        foreach ($this->hand as $card) {
            $this->points += $card->get_points();
        }

        if ($this->points > 21) {
            foreach ($this->hand as $card) {
                if ($card->get_points() == "11") {
                    $card->reduce_a();
                    $this->set_points();
                    break;
                }
            }
        }
    }
}
