<?php

namespace App\Card;

class BJ
{
    public $dealer;
    public $players = array();
    public $deck;

    public function __construct($num, $pile)
    {
        $this->dealer = new BJPlayer();
        $this->deck = $pile;
        $this->dealer_draw_two();
        $count = 0;

        while ($num > 0) {
            array_push($this->players, new BJPlayer());

            $this->player_draw_two($count);

            $num -= 1;
            $count += 1;
        }
    }

    public function dealer_draw_two()
    {
        $dealer = $this->dealer;
        $dealer->add_card($this->deck->draw());
        $dealer->add_card($this->deck->draw());
        $dealer->set_points();
    }

    public function player_draw_two($num)
    {
        $player = $this->players[$num];
        $player->add_card($this->deck->draw());
        $player->add_card($this->deck->draw());
        $player->set_points();

        if ($player->get_points() == 21) {
            $player->set_state(4);
        }
    }

    public function hit()
    {
        foreach ($this->players as $player) {
            if ($player->get_state() == 1) {
                $player->add_card($this->deck->draw());
                $player->set_points();

                if ($player->get_points() > 21) {
                    $player->set_state(0);
                } elseif ($player->get_points() == 21) {
                    $player->set_state(2);
                }
                break;
            }
        }
    }

    public function stand()
    {
        foreach ($this->players as $player) {
            if ($player->get_state() == 1) {
                $player->set_state(2);
                break;
            }
        }
    }
}
