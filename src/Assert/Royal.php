<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Assert;

/**
 * Royal is an class made for asserting if an array of App\Poker\PokerCard objects are ascending in a specific order
 */
class Royal
{
    /**
     * The $bool property represents if the objects are defined as royal by the class
     *
     * @var bool
     */
    public bool $bool;

    /**
     * Constructing method for the class
     *
     * Assigns the $this->bool value of the class to false
     */
    public function __construct()
    {
        $this->bool = false;
    }

    /**
     * Main method for asserting if the objects are matching
     * 
     * The method returns an boolean value, that is stored in the $this->bool propertie, when the methods have been run
     * 
     * @param array $stack is the array to be asserted if it contains the objects to be counted as royal
     */
    public function assert(array $stack): bool
    {
        $this->adduce($stack);

        return $this->bool;
    }

    /**
     * Assisting method for the $this->assert method
     * 
     * The method checks for values that match the preset, and if the $stack array contains all preset-values, it then assigns an boolean value to the $this->bool property
     * 
     * @param array $stack is the array to be asserted if it conatins matching objects
     */
    protected function adduce(array $stack): void
    {
        $royal = ["A", 10, "J", "Q", "K"];

        foreach ($stack as $card) {
            foreach ($royal as $roy) {
                if ($card->get_value() == $roy) {
                    $royal = array_diff($royal, [$roy]);
                }
            }
        }

        if ($royal == []) {
            $this->bool = true;
        }
    }
}
