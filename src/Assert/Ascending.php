<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Assert;

use App\Poker\PokerCard;
/**
 * Ascending is an class made for asserting if an array of App\Poker\PokerCard objects are asceding in order
 * 
 * Example: (1, 2, 3, 4) and (4, 2, 3, 1) are both 'ascending'
 */
class Ascending
{
    /**
     * The $bool property represents if the objects are ascending in order
     *
     * @var bool
     */
    public bool $bool;

    /**
     * The $value property holds the first object of the ascending order of objects
     *
     * @var array
     */
    public array $value = array();

    /**
     * Constructing method for the class
     *
     * Assigns the $bool value of the class to false
     */
    public function __construct()
    {
        $this->bool = false;
    }

    /**
     * Main method for asserting if the objects are in ascending order
     * 
     * The method makes sure that the supporting methods run at least once per item in $stack array and runs an extra time if it ecounters an ace-card-object
     */
    public function assert(array $stack, int $num): bool
    {
        foreach($stack as $prime) {
            if ($prime->get_points() == 14) {
                $this->adduce(1, $stack, $num);
            }
            $this->adduce($prime->get_points(), $stack, $num);
        }

        return $this->bool;
    }

    /**
     * Assisting method for the $this->assert method
     * 
     * The method makes sure that the methods runs as many times as requested through the $num variable
     */
    protected function adduce(int $prime, array $stack, int $num) {
        $count = $num;
        $final = 1;

        while ($count > 0) {
            $final += $this->identify($prime + $count, $stack);
            $count -= 1;
        }

        if ($final == $num) {
            $this->bool = true;
            array_push($this->value, $prime);
        }
    }

    /**
     * Second assisting method for the $this->assert method
     * 
     * The method runs returns an 1 if the $stack array contains an object with the required value, and 0 if not
     */
    protected function identify(int $value, array $stack): int
    {
        $final = 0;

        foreach($stack as $second) {
            if ($second->get_points() == $value) {
                $final += 1;
                break;
            }
        }

        return $final;
    }
}