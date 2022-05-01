<?php

/**
 * This file is a module containing the BJDeck class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Card;

use App\Card\BJCard;

/**
 * The BJDeck is an extendtion of the App\Card\Deck class
 * that contains a extra method, specificly for Black Jack (BJ) games
 */
class BJDeck extends Deck
{
    /**
     * Constructing method for the class
     *
     * Using the bj_insert() method, creates a complete sorted deck ($ordered)
     * and then adds all objects to another array with the shuffle() method,
     * but out of order ($pile)
     */
    public function __construct()
    {
        $this->bj_insert();
        $this->shuffle();
    }

    /**
     * Method for adding a whole deck to the $orderd array-property
     *
     * Differense from App\Card\Deck is the use of App\Card\BJCard objects
     * instead of App\Card\Card objects
     */
    protected function bj_insert(): void
    {
        $patterns = array("D", "C", "H", "S");
        $values = array("A", 2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K");

        foreach ($patterns as $pattern) {
            foreach ($values as $value) {
                array_push($this->ordered, new BJCard($value, $pattern));
            }
        }
    }
}
