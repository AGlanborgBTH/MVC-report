<?php

namespace App\Card;

class BJ
{
    public $dealer;
    // state 0 == hidden second card
    // state 1 == revealed second card and playing
    // state 2 == finnished
    public $players = array();
    // state 0 == playing
    // state 1 == hold
    // state 2 == lost
    // state 3 == draw
    // state 4 == won
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

    public function dealer_draw()
    {
        $this->dealer->add_card($this->deck->draw());
    }

    public function dealer_draw_two()
    {
        $this->dealer->add_card($this->deck->draw());
        $this->dealer->add_card($this->deck->draw());
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
            if ($player->get_state() == 0) {
                $player->add_card($this->deck->draw());
                $player->set_points();

                if ($player->get_points() > 21) {
                    $player->set_state(2);
                } elseif ($player->get_points() == 21) {
                    $player->set_state(1);
                }
                break;
            }
        }
    }

    public function stand()
    {
        foreach ($this->players as $player) {
            if ($player->get_state() == 0) {
                $player->set_state(1);
                break;
            }
        }
    }

    public function continue()
    {
        $dealer = $this->dealer;

        if ($dealer->get_points() == 0) {
            $dealer->set_points();
            $dealer->set_state(1);
        } else {
            if ($dealer->get_points() >= 16 and $dealer->get_points() <= 21) {
                foreach ($this->players as $player) {
                    if ($player->get_state() == 1) {
                        if ($player->get_points() == $dealer->get_points()) {
                            $player->set_state(3);
                        } elseif ($player->get_points() > $dealer->get_points()) {
                            $player->set_state(4);
                        } else {
                            $player->set_state(2);
                        }
                    }
                }
                $dealer->set_state(2);
            } elseif ($dealer->get_points() > 21) {
                foreach ($this->players as $player) {
                    if ($player->get_state() == 1) {
                        $player->set_state(4);
                    }
                }
                $dealer->set_state(2);
            } else {
                $this->dealer_draw();
                $dealer->set_points();
                if ($dealer->get_points() >= 16) {
                    $this->continue();
                }
            }
        }
    }
}
