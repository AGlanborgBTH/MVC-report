<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Assisting;

/**
 * The BJ is an class made to hold playing Black Jack (BJ)
 */
class Dealer
{
    /**
     * Method for when the dealer is to act
     * 
     * Player states and dealer state will alter depending on dealer state and points
     * 
     * @param object $dealer BJPlayer object for dictating actions taken
     * 
     * @param array $players array of BJPlayer object affected by the state of $dealer
     * 
     * @param object $deck BJDeck object for the dealer to draw from
     */
    public function continue($dealer, $players, $deck): void
    {
        if ($dealer->get_points() > 21) {
            $this->dealer_high($players);
            $dealer->set_state(2);
        } elseif ($dealer->get_points() >= 16) {
            $this->dealer_land($dealer, $players);
            $dealer->set_state(2);
        } else {
            $this->dealer_draw($dealer, $deck);
            $dealer->set_points();
        }
    }

    /**
     * Method for when the dealer hits within the stopping range
     * 
     * @param object $dealer BJPlayer object for dictating actions taken
     * 
     * @param array $players array of BJPlayer object affected by the state of $dealer
     */
    private function dealer_land($dealer, $players): void
    {
        foreach ($players as $player) {
            if ($player->get_state() == 1) {
                $this->dealer_land_check($dealer, $player);
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
     * 
     * @param object $dealer BJPlayer object for dictating actions taken
     * 
     * @param object $player  BJPlayer object to be changed state
     */
    private function dealer_land_check($dealer, $player): void
    {
        if ($player->get_points() == $dealer->get_points()) {
            $player->set_state(3);
        } elseif ($player->get_points() > $dealer->get_points()) {
            $player->set_state(4);
        } else {
            $player->set_state(2);
        }
    }

    /**
     * Method for when the dealer hits beyond the stopping range
     *
     * The function makes all playing players who exceed the dealer set sate to "WIN"
     * 
     * @param array $players array of BJPlayer object affected by the state of $dealer
     */
    private function dealer_high($players): void
    {
        foreach ($players as $player) {
            if ($player->get_state() == 1) {
                $player->set_state(4);
            }
        }
    }

    /**
     * Method for adding a BJCard-object to the $dealer property
     * 
     * @param object $dealer BJPlayer object for dictating actions taken
     * 
     * @param object $deck BJDeck object for the dealer to draw from
     */
    private function dealer_draw($dealer, $deck): void
    {
        $dealer->add_card($deck->draw());
    }
}