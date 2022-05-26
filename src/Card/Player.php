<?php

/**
 * This file is a module containing the Player class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Card;

/**
 * The Player class is a blaseline class to be used for
 * games using players and/or used to be expanded into
 * more specific player classes
 */
class Player
{
    /**
     * Holding property for card-objects
     *
     * @var array
     */
    public $hand = array();

    /**
     * Adds App\Card\Card-object to $hand array-property
     *
     * @param object $card Card-object to be added to $hand
     */
    public function addCard(object $card): void
    {
        array_push($this->hand, $card);
    }

    /**
     * Clears the content held in the $hand array-property
     */
    public function clearHand(): void
    {
        $this->hand = array();
    }
}
