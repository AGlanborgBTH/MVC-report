<?php

/**
 * This file is a module containing the BJCard class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Poker;

/**
 * PokerPlayer is an class made for playing virtual Poker as a part of the App\Poker\Poker class
 */
class PokerPlayer
{
    /**
     * $hand is an property made for containing an array of App\Poker\PokerCard objects
     *
     * @var array
     */
    public array $hand = array();

    /**
     * $hand_rank is an property made for conataining the value of the rank that the App\Poker\PokerCard objects compose
     *
     * @var array
     */
    public array $hand_rank;

    /**
     * Constructing method for the class
     *
     * The method assigns array to $this->hand property if parameter is filled
     *
     * @param array $hand optional parameter for applying an array to the $this->hand property
     */
    public function __construct(array $hand = null)
    {
        if ($hand) {
            $this->hand = $hand;
        }
    }

    /**
     * Method for adding objects to the $this->hand property
     *
     * @param object $card the object to be added to the $this->hand property
     */
    public function addCard(object $card): void
    {
        array_push($this->hand, $card);
    }
}
