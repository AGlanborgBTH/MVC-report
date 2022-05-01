<?php

/**
 * This file is a module containing the Deck class
 * 
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Card;

use App\Card\Card;

/**
 * The Deck is an class made to hold App\Card\Card objects
 * in order ($ordered) and out of order ($pile)
 */
class Deck
{
    /**
     * Holding property for card-objects in order
     * 
     * @var array
     */
    public $ordered = array();

    /**
     * Holding property for card-objects in out of order
     * 
     * @var array
     */
    public $pile = array();

    /**
     * Constructing method for the class
     * 
     * Using the insert() method, creates a complete sorted deck ($ordered)
     * and then adds all objects to another array with the shuffle() method,
     * but out of order ($pile)
     */
    public function __construct()
    {
        $this->insert();
        $this->shuffle();
    }

    /**
     * Method for adding a whole deck to the $orderd array-property
     */
    protected function insert(): void
    {
        $patterns = array("D", "C", "H", "S");
        $values = array("A", 2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K");

        foreach ($patterns as $pattern) {
            foreach ($values as $value) {
                array_push($this->ordered, new Card($value, $pattern));
            }
        }
    }

    /**
     * Method for adding the content of the $orderd array-property to the
     * $pile array-property, but out of order
     */
    public function shuffle(): void
    {
        $temp = $this->ordered;
        $this->pile = array();

        while (count($temp) > 0) {
            $card =  array_splice($temp, rand(0, count($temp) - 1), 1);
            array_push($this->pile, $card[0]);
        }
    }

    /**
     * Method for removing and returning the top card of the $pile
     * array-property
     */
    public function draw(): mixed
    {
        return array_pop($this->pile);
    }
}
