<?php

/**
 * This file is a module containing the BJPlayer class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Card;

/**
 * The BJPlayer is an extendtion of the App\Card\Player class
 * that contains extra methods and properties, specificly for
 * Black Jack (BJ) games
 */
class BJPlayer extends Player
{
    /**
     * Value property for holding the current state of the player object
     *
     * @var int
     */
    protected int $state;

    /**
     * Value property for holding the current points of the player object
     *
     * @var int
     */
    protected int $points;

    /**
     * Constructing method for the class
     *
     * Sets the $state- and $points-properties to the default value of 0
     */
    public function __construct()
    {
        $this->state = 0;
        $this->points = 0;
    }

    /**
     * Get-method for returning the protected $state property
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * Set-method for changing the protected $state property
     *
     * @param int $num Parameter dictating the state of the player object
     */
    public function setState(int $num): void
    {
        $this->state = $num;
    }

    /**
     * Get-method for returning the protected $points property
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * Set-method for changing the protected $points property
     *
     * The value of the points is dependent on the rules of the BJ game
     *
     * This method follows the rules of BJ and sets the points depending
     * on that factor
     */
    public function setPoints(): void
    {
        $this->points = 0;

        foreach ($this->hand as $card) {
            $this->points += $card->getPoints();
        }

        if ($this->points > 21) {
            foreach ($this->hand as $card) {
                if ($card->getPoints() == "11") {
                    $card->reduceA();
                    $this->setPoints();
                    break;
                }
            }
        }
    }
}
