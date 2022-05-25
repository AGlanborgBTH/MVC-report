<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Poker;

class PokerHandRank
{
    public object $royal_flush;

    public object $straight_flush;

    public object $four;

    public object $full_house;

    public object $flush;

    public object $straight;

    public object $three;

    public object $two_pair;

    public object $pair;

    public function initialize($hand, $table) {
        $stack = $this->make_pile($hand, $table);
        $this->royal_flush = new \App\Rank\Royal_flush($stack);
        $this->straight_flush = new \App\Rank\Straight_flush($stack);
        $this->four = new \App\Rank\Four($stack);
        $this->full_house = new \App\Rank\Full_house($stack);
        $this->flush = new \App\Rank\Flush($stack);
        $this->straight = new \App\Rank\Straight($stack);
        $this->three = new \App\Rank\Three($stack);
        $this->two_pair = new \App\Rank\Two_pair($stack);
        $this->pair = new \App\Rank\Pair($stack);
    }

    public function make_pile($hand, $table) {
        $final = $hand;

        foreach($table as $card) {
            array_push($final, $card);
        }

        return $final;
    }

    public function result(): array
    {
        if ($this->royal_flush->result()) {
            return [10, "Royal Flush"];
        } elseif($this->straight_flush->result()) {
            return [9, "Straight Flush"];
        } elseif($this->four->result()) {
            return [8, "Four of a Kind"];
        } elseif($this->full_house->result()) {
            return [7, "Full House"];
        } elseif($this->flush->result()) {
            return [6, "Flush"];
        } elseif($this->straight->result()) {
            return [5, "Straight"];
        } elseif($this->three->result()) {
            return [4, "Three of a Kind"];
        } elseif($this->two_pair->result()) {
            return [3, "Two Pair"];
        } elseif($this->pair->result()) {
            return [2, "Pair"];
        } else {
            return [1, "High Card"];
        }
    }
}