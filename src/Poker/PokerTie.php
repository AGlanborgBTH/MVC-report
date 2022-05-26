<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Poker;

/**
 * PokerTie is an class made for disputing the conflict of two similarly ranked hands in the App\Poker\Poker
 * class/game
 */
class PokerTie
{
    /**
     * $high is an object for disputing the onflict of two similarly ranked hands in the App\Poker\Poker
     * class/game, when they both contain high ranked values/cards
     *
     * @var object
     */
    public object $high;

    /**
     * $low is an object for disputing the onflict of two similarly ranked hands in the App\Poker\Poker
     * class/game, when they both contain low ranked values/cards
     *
     * @var object
     */
    public object $low;

    /**
     * Constructing method for the class
     *
     * Method for assigning all properties the right class/object
     */
    public function __construct()
    {
        $this->high = new PokerHigh();
        $this->low = new PokerLow();
    }

    /**
     * Method for returning the result of assessing all hand rankings and hand content
     *
     * @param object $player App\Poker\PokerHandRank that defines the content of $player_hand
     *
     * @param object $dealer App\Poker\PokerHandRank that defines the content of $dealer_hand
     *
     * @param array $player_hand the first of the arrays of App\Poker\PokerCard objects to be compared
     *
     * @param array $dealer_hand the second of the arrays App\Poker\PokerCard objects to be compared
     *
     * @param array $table_hand an array containing App\Poker\PokerCard objects; shared among $player and $dealer
     */
    public function result($player, $dealer, $player_hand, $dealer_hand, $table_hand): int
    {
        if (
            (
                $player->royal_flush->result() and
                $dealer->royal_flush->result()
            ) or (
                $player->straight_flush->result() and
                $dealer->straight_flush->result()
            ) or (
                $player->four->result() and
                $dealer->four->result()
            ) or (
                $player->full_house->result() and
                $dealer->full_house->result()
            ) or (
                $player->flush->result() and
                $dealer->flush->result()
                )
        ) {
            return $this->high->result($player, $dealer, $player_hand, $dealer_hand, $table_hand);
        }
        return $this->low->result($player, $dealer, $player_hand, $dealer_hand, $table_hand);
    }
}
