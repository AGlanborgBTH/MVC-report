<?php

namespace App\Card;

class Game
{
    public $dealer;
    public $players = array();
    public $deck;

    public function __construct($num, $pile)
    {
        $this->dealer = new Player();
        $this->deck = $pile;
        $this->dealer_draw_two();
        $count = 0;

        while ($num > 0) {
            array_push($this->players, new Player());

            $this->player_draw_two($count);

            $num -= 1;
            $count += 1;
        }
    }

    public function dealer_draw()
    {
        $this->dealer->add_card($this->deck->draw());
    }

    public function dealer_draw_two()
    {
        $this->dealer->add_card($this->deck->draw());
        $this->dealer->add_card($this->deck->draw());
    }

    public function player_draw($num)
    {
        $this->players[$num]->add_card($this->deck->draw());
    }

    public function player_draw_two($num)
    {
        $this->players[$num]->add_card($this->deck->draw());
        $this->players[$num]->add_card($this->deck->draw());
    }
}