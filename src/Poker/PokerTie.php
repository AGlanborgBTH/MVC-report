<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Poker;

class PokerTie
{
    public object $ascending;

    public object $set;

    public object $grouping;

    public object $high;

    public object $four;
    
    public object $three;

    public object $two;

    public object $pair;

    public function __construct()
    {
        $this->ascending = new \App\Stalemate\Ascending;
        $this->set = new \App\Stalemate\Set;
        $this->grouping = new \App\Stalemate\Grouping;
        $this->high = new \App\Stalemate\High;
        $this->four = new \App\Stalemate\Four;
        $this->three = new \App\Stalemate\Three;
        $this->two = new \App\Stalemate\Two;
        $this->pair = new \App\Stalemate\Pair;
    }

    public function result($player, $dealer, $player_hand, $dealer_hand, $table_hand): int
    {
        if ($player->royal_flush->result() and $dealer->royal_flush->result()) {
            return 5;

        } elseif ($player->straight_flush->result() and $dealer->straight_flush->result()) {
            return $this->ascending->result($player->straight_flush, $dealer->straight_flush);

        } elseif ($player->four->result() and $dealer->four->result()) {
            return $this->four->result($player->four, $dealer->four, $player_hand, $dealer_hand, $table_hand);

        } elseif ($player->full_house->result() and $dealer->full_house->result()) {
            return $this->set->result($player->full_house, $dealer->full_house);

        } elseif ($player->flush->result() and $dealer->flush->result()) {
            return $this->grouping->result($player->flush, $dealer->flush);

        } elseif ($player->straight->result() and $dealer->straight->result()) {
            return $this->ascending->result($player->straight, $dealer->straight);

        } elseif ($player->three->result() and $dealer->three->result()) {
            return $this->three->result($player->three, $dealer->three, $player_hand, $dealer_hand, $table_hand);

        } elseif ($player->two_pair->result() and $dealer->two_pair->result()) {
            return $this->two->result($player->two_pair, $dealer->two_pair, $player_hand, $dealer_hand, $table_hand);

        } elseif ($player->pair->result() and $dealer->pair->result()) {
            return $this->pair->result($player->pair, $dealer->pair, $player_hand, $dealer_hand, $table_hand);

        } else {
            return $this->high->result($player_hand, $dealer_hand);
        }
    }
}