<?php

namespace App\Card;

class BJPlayer extends Player
{
    protected $state;
    protected $points;

    public function __construct()
    {
        $this->state = 0;
        $this->points = 0;
    }

    public function get_state(): int
    {
        return $this->state;
    }

    public function set_state($num): void
    {
        $this->state = $num;
    }

    public function get_points(): int
    {
        return $this->points;
    }

    public function set_points(): void
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
