<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Card;

use App\Card\BJPlayer;
use App\Card\BJDeck;

/**
 * The BJ is an class made to hold playing Black Jack (BJ)
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
        $this->dealer_draw_two();
        $count = 0;

        while ($num > 0) {
            array_push($this->players, new BJPlayer());

            $this->player_draw_two($count);

            $num -= 1;
            $count += 1;
        }
    }

    /**
     * Method for adding a BJCard-object to the $dealer property
     */
    public function dealer_draw(): void
    {
        $this->dealer->add_card($this->deck->draw());
    }

    /**
     * Method for adding two BJCard-objects to the $dealer property
     */
    public function dealer_draw_two(): void
    {
        $this->dealer->add_card($this->deck->draw());
        $this->dealer->add_card($this->deck->draw());
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
    public function player_draw_two(int $num): void
    {
        $player = $this->players[$num];
        $player->add_card($this->deck->draw());
        $player->add_card($this->deck->draw());
        $player->set_points();

        if ($player->get_points() == 21) {
            $player->set_state(4);
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
            if ($player->get_state() == 0) {
                $player->add_card($this->deck->draw());
                $player->set_points();

                if ($player->get_points() > 21) {
                    $player->set_state(2);
                } elseif ($player->get_points() == 21) {
                    $player->set_state(1);
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
            if ($player->get_state() == 0) {
                $player->set_state(1);
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
        $dealer = $this->dealer;

        if ($dealer->get_points() == 0) {
            $dealer->set_points();
            $dealer->set_state(1);
        } else {
            if ($dealer->get_points() >= 16 and $dealer->get_points() <= 21) {
                $this->dealer_land();
                $dealer->set_state(2);
            } elseif ($dealer->get_points() > 21) {
                $this->dealer_high();
                $dealer->set_state(2);
            } else {
                $this->dealer_draw();
                $dealer->set_points();
            }
        }
    }

    /**
     * Method for when the dealer hits within the stopping range
     *
     * The function makes all playing players who tie the dealer set sate to "TIE"
     *
     * The function makes all playing players who exceed the dealer set sate to "WIN"
     * 
     * The function makes all playing players who looses to the dealer set sate to "LOOSE"
     */
    private function dealer_land() {
        foreach ($this->players as $player) {
            if ($player->get_state() == 1) {
                if ($player->get_points() == $this->dealer->get_points()) {
                    $player->set_state(3);
                } elseif ($player->get_points() > $this->dealer->get_points()) {
                    $player->set_state(4);
                } else {
                    $player->set_state(2);
                }
            }
        }
    }

    /**
     * Method for when the dealer hits beyond the stopping range
     *
     * The function makes all playing players who exceed the dealer set sate to "WIN"
     */
    private function dealer_high() {
        foreach ($this->players as $player) {
            if ($player->get_state() == 1) {
                $player->set_state(4);
            }
        }
    }
}
