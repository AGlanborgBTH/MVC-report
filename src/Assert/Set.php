<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Assert;

/**
 * Set is an class made for asserting if an array of App\Poker\PokerCard objects contain multiple objects who are
 * matching (2 groups/values)
 */
class Set
{
    /**
     * The $bool property represents if the objects have mulitple groups/values of matching objects
     *
     * @var bool
     */
    public bool $bool;

    /**
     * The $value property holds the two values that the objects are matching in
     *
     * @var array
     */
    public array $value = array();

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
     * The method returns an boolean value, that is stored in the $this->bool property, when the methods have been run
     *
     * @param array $stack is the array to be asserted if it contains the objects that are to be compared
     *
     * @param int $large is the number that will dictate how many the larger matching objects must contain
     *
     * @param int $small is the number that will dictate how many the smaller- or equally sized- matching objects must
     * contain
     */
    public function assert(array $stack, int $large, int $small): bool
    {
        $this->adduce($stack, $large, $small);

        return $this->bool;
    }

    /**
     * Assisting method for the $this->assert method
     *
     * The method runs the $this->identify method twice, but only if the object contains matching pair that are of the
     * $large count
     *
     * The method will assign values to the $this->bool and $this->value properties if both the $large and $small amount
     * of matching pairs are forfilled
     *
     * @param array $stack is the array to be asserted if it contains the objects that are to be compared
     *
     * @param int $large is the number that will dictate how many the larger matching objects must contain
     *
     * @param int $small is the number that will dictate how many the smaller- or equally sized- matching objects must
     * contain
     */
    protected function adduce(array $stack, int $large, int $small): void
    {
        $prime = $this->identify($stack, $large);

        if ($prime[0]) {
            $second = $this->identify($stack, $small, $prime[1]);

            if ($second[0]) {
                $this->bool = true;
                $this->value = [$prime[1], $second[1]];
            }
        }
    }

    /**
     * Second assisting method for the $this->assert method
     *
     * The method loops trough the $stack and asserts if they contain enough of the same valued objects
     *
     * @param array $stack is the array to be asserted if it contains the objects that are to be compared
     *
     * @param int $num is the number the amount of objects that has to have the same value
     *
     * @param int $large is an optional number that will make the method not return an allready used value
     */
    protected function identify(array $stack, int $num, int $large = null): array
    {
        $is_value = null;
        $is_true = false;

        foreach ($stack as $prime) {
            $count = 0;

            foreach ($stack as $second) {
                if ($prime->getPoints() == $second->getPoints() and $prime->getPoints() != $large) {
                    $count += 1;
                }
            }

            if ($count == $num) {
                $is_true = true;
                $is_value = $prime->getPoints();
                break;
            }
        }

        return [$is_true, $is_value];
    }
}
