<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Assert;

/**
 * Grouping is an class made for asserting if an array of App\Poker\PokerCard objects are of the same pattern
 */
class Grouping
{
    /**
     * The $bool property represents if the objects are defined as grouped by the class
     *
     * @var bool
     */
    public bool $bool;

    /**
     * The $value property holds the objects that are grouped objects
     *
     * @var array
     */
    public array $value;

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
     * Main method for asserting if the objects are grouping
     *
     * The method returns an boolean value, that is stored in the $this->bool propertie, when the methods have been run
     *
     * @param array $stack is the array to be asserted if it is grouping
     *
     * @param int $num is the number of cards the group must have to pass/count
     */
    public function assert(array $stack, int $num): bool
    {
        $this->adduce($stack, $num);

        return $this->bool;
    }

    /**
     * Assisting method for the $this->assert method
     *
     * The method counts the amount of objects who are in the same group, and if they pass the $num amount, they are
     * saved in the $this->bool- and $this->value-properties
     *
     * @param array $stack is the array to be asserted if it is grouping
     *
     * @param int $num is the number of cards the group must have to pass/count
     */
    protected function adduce(array $stack, int $num): void
    {
        foreach ($stack as $prime) {
            $final = 0;
            $arr = [];

            foreach ($stack as $second) {
                if ($prime->getPattern() == $second->getPattern()) {
                    $final += 1;
                    array_push($arr, $second);
                }
            }

            if ($final >= $num) {
                $this->bool = true;
                $this->value = $arr;
                break;
            }
        }
    }
}
