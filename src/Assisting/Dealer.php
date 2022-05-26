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
        if ($dealer->getPoints() > 21) {
            $this->dealerHigh($players);
            $dealer->setState(2);
        } elseif ($dealer->getPoints() >= 16) {
            $this->dealerLand($dealer, $players);
            $dealer->setState(2);
        } else {
            $this->dealerDraw($dealer, $deck);
            $dealer->setPoints();
        }
    }

    /**
     * Method for when the dealer hits within the stopping range
     *
     * @param object $dealer BJPlayer object for dictating actions taken
     *
     * @param array $players array of BJPlayer object affected by the state of $dealer
     */
    private function dealerLand($dealer, $players): void
    {
        foreach ($players as $player) {
            if ($player->getState() == 1) {
                $this->dealerLandCheck($dealer, $player);
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
    private function dealerLandCheck($dealer, $player): void
    {
        if ($player->getPoints() == $dealer->getPoints()) {
            $player->setState(3);
        } elseif ($player->getPoints() > $dealer->getPoints()) {
            $player->setState(4);
        } else {
            $player->setState(2);
        }
    }

    /**
     * Method for when the dealer hits beyond the stopping range
     *
     * The function makes all playing players who exceed the dealer set sate to "WIN"
     *
     * @param array $players array of BJPlayer object affected by the state of $dealer
     */
    private function dealerHigh($players): void
    {
        foreach ($players as $player) {
            if ($player->getState() == 1) {
                $player->setState(4);
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
    private function dealerDraw($dealer, $deck): void
    {
        $dealer->addCard($deck->draw());
    }
}
