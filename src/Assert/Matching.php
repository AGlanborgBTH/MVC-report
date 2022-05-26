<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Assert;

/**
 * Matching is an class made for asserting if an array of App\Poker\PokerCard objects are of the same points/value
 */
class Matching
{
    /**
     * The $bool property represents if the objects are defined as matching by the class
     *
     * @var bool
     */
    public bool $bool;

    /**
     * The $value property holds the value of the objects who are matching
     *
     * @var int
     */
    public int $value;

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
     * @param array $stack is the array to be asserted if it contains matching objects
     *
     * @param int $num is the number of cards the matching cards must have to pass/count
     */
    public function assert(array $stack, int $num): bool
    {
        $this->adduce($stack, $num);

        return $this->bool;
    }

    /**
     * Assisting method for the $this->assert method
     *
     * The method counts the amount of objects who are of the same value, and if they pass the $num amount, they are
     * saved in the $this->bool- and $this->value-properties
     *
     * @param array $stack is the array to be asserted if it conatins matching objects
     *
     * @param int $num is the number of cards the group must have to pass/count
     */
    protected function adduce(array $stack, int $num): void
    {
        foreach ($stack as $prime) {
            $final = 0;

            foreach ($stack as $second) {
                if ($prime->getPoints() == $second->getPoints()) {
                    $final += 1;
                }
            }

            if ($final == $num) {
                $this->bool = true;
                $this->value = $prime->getPoints();
            }
        }
    }
}
