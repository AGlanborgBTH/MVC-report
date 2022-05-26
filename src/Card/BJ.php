<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Card;

use App\Card\BJPlayer;
use App\Card\BJDeck;
use App\Assisting\Dealer;

/**
 * BJ is an class made to hold playing Black Jack (BJ)
 */
class BJ
{
    /**
     * Holding property for BJPlayer object
     *
     * * state 0 == hidden second card
     * * state 1 == revealed second card and playing
     * * state 2 == finnished
     *
     * @var object
     */
    public object $dealer;

    /**
     * Holding property for BJPlayer objects
     *
     * * state 0 == playing
     * * state 1 == hold
     * * state 2 == lost
     * * state 3 == draw
     * * state 4 == won
     *
     * @var array
     */
    public $players = array();

    /**
     * Holding property for BJDeck object
     *
     * @var object
     */
    public object $deck;

    /**
     * Constructing method for the class
     *
     * Assigns the $dealer property with an BJPlayer object and the $deck property
     * with an BJDeck object. Then it adds as many BJPlayer objects to the $players
     * array-object as specified in the $num parameter
     *
     * @param int $num Amount of BJPlayer objects to add to $players array-property
     */
    public function __construct(int $num)
    {
        $this->dealer = new BJPlayer();
        $this->deck = new BJDeck();
        $this->dealerDrawTwo();
        $count = 0;

        while ($num > 0) {
            array_push($this->players, new BJPlayer());

            $this->playerDrawTwo($count);

            $num -= 1;
            $count += 1;
        }
    }

    /**
     * Method for adding two BJCard-objects to the $dealer property
     */
    public function dealerDrawTwo(): void
    {
        $this->dealer->addCard($this->deck->draw());
        $this->dealer->addCard($this->deck->draw());
    }

    /**
     * Method for adding two BJCard-objects to the $players[$num] property
     * and updating state
     *
     * This is a method used when starting a BJ session, therefor it will
     * update the state of the player if total points equal 21
     *
     * @param int $num Select object in $players array-property
     */
    public function playerDrawTwo(int $num): void
    {
        $player = $this->players[$num];
        $player->addCard($this->deck->draw());
        $player->addCard($this->deck->draw());
        $player->setPoints();

        if ($player->getPoints() == 21) {
            $player->setState(4);
        }
    }

    /**
     * Method for adding a extra BJCard object to- and update state of- the
     * first BJPlayer object in the players array-property that has a state
     * of 0
     *
     * The state set is dependent on the rules of the BJ game
     *
     * This method follows the rules of BJ and sets the state depending on
     * that factor
     */
    public function hit(): void
    {
        foreach ($this->players as $player) {
            if ($player->getState() == 0) {
                $player->addCard($this->deck->draw());
                $player->setPoints();

                if ($player->getPoints() > 21) {
                    $player->setState(2);
                } elseif ($player->getPoints() == 21) {
                    $player->setState(1);
                }
                break;
            }
        }
    }

    /**
     * Method for changing the state-property of the first BJPlayer object in
     * the $players array-property that has a state value of 0 to 1
     */
    public function stand(): void
    {
        foreach ($this->players as $player) {
            if ($player->getState() == 0) {
                $player->setState(1);
                break;
            }
        }
    }

    /**
     * Method for playing the dealer
     *
     * The dealers actions are automated and may be needed to be repeated
     * multiple times to complete all possible actions
     *
     * The actions done is dependent on the rules of the BJ game
     *
     * This method follows the rules of BJ and acts depending on that factor
     */
    public function continue(): void
    {
        if ($this->dealer->getPoints() == 0) {
            $this->dealer->setPoints();
            $this->dealer->setState(1);
        } else {
            $dealer = new Dealer();
            $dealer->continue($this->dealer, $this->players, $this->deck);
        }
    }
}
