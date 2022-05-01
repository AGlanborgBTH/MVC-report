<?php

/**
 * This file is a module containing the DeckWith2Jokers class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Card;

use App\Card\Card;

/**
 * The DeckWith2Jokers is an extendtion of the App\Card\Deck class
 * that contains two more cards in the ordered- and pile-property
 */
class DeckWith2Jokers extends Deck
{
    /**
     * Constructing method for the class
     *
     * Using the insert() method, creates a complete sorted deck ($ordered)
     * with two extra cards (jokers) and then adds all objects to another
     * array with the shuffle() method, but out of order ($pile)
     *
     * * "*" represents no value
     * * "J" represents Joker
     */
    public function __construct()
    {
        $this->insert();

        array_push($this->ordered, new Card("*", "J"));
        array_push($this->ordered, new Card("*", "J"));

        $this->shuffle();
    }
}
