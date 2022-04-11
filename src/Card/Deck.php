<?php

namespace App\Card;

use App\Card\Card;

class Deck
{
    public $ordered = array();
    public $pile = array();

    public function __construct()
    {
        $this->insert();
        $this->shuffle();
    }

    protected function insert()
    {
        $patterns = array("D", "C", "H", "S");
        $values = array("A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K");

        foreach ($patterns as $pattern) {
            foreach ($values as $value) {
                array_push($this->ordered, new Card($value, $pattern));
            }
        }
    }

    public function shuffle()
    {
        $temp = $this->ordered;
        $this->pile = array();

        while (count($temp) > 0) {
            $card =  array_splice($temp, rand(0, count($temp) - 1), 1);
            array_push($this->pile, $card[0]);
        }
    }

    public function draw(): mixed
    {
        return array_pop($this->pile);
    }
}
