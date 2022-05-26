<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Poker;

/**
 * PokerHandRank is an class made for asserting the value of a 'players' cards in virtual Poker
 */
class PokerHandRank
{
    /**
     * $royal_flush is an property containing an object for asserting if an array of App\Poker\PokerCard objects
     * contain a royal flush
     *
     * @var object
     */
    public object $royal_flush;

    /**
     * $straight_flush is an property containing an object for asserting if an array of App\Poker\PokerCard objects
     * contain a straight flush
     *
     * @var object
     */
    public object $straight_flush;

    /**
     * $four is an property containing an object for asserting if an array of App\Poker\PokerCard objects contain
     * four of the same kind
     *
     * @var object
     */
    public object $four;

    /**
     * $full_house is an property containing an object for asserting if an array of App\Poker\PokerCard objects
     * contain a full house
     *
     * @var object
     */
    public object $full_house;

    /**
     * $flush is an property containing an object for asserting if an array of App\Poker\PokerCard objects contain a
     * flush
     *
     * @var object
     */
    public object $flush;

    /**
     * $straight is an property containing an object for asserting if an array of App\Poker\PokerCard objects contain
     * a straight
     *
     * @var object
     */
    public object $straight;

    /**
     * $three is an property containing an object for asserting if an array of App\Poker\PokerCard objects contain three
     * of the same kind
     *
     * @var object
     */
    public object $three;

    /**
     * $two_pair is an property containing an object for asserting if an array of App\Poker\PokerCard objects contain
     * two pairs
     *
     * @var object
     */
    public object $two_pair;

    /**
     * $pair is an property containing an object for asserting if an array of App\Poker\PokerCard objects contain a pair
     *
     * @var object
     */
    public object $pair;

    /**
     * Main method for asserting the rank of two arrays with App\Poker\PokerCard objects
     *
     * @param array $hand the first of two arrays conatining App\Poker\PokerCard objects; to be asserted rank
     *
     * @param array $table the second of two arrays conatining App\Poker\PokerCard objects; to be asserted rank
     */
    public function initialize(array $hand, array $table): void
    {
        $stack = $this->makePile($hand, $table);
        $this->royal_flush = new \App\Rank\RoyalFlush($stack);
        $this->straight_flush = new \App\Rank\StraightFlush($stack);
        $this->four = new \App\Rank\Four($stack);
        $this->full_house = new \App\Rank\FullHouse($stack);
        $this->flush = new \App\Rank\Flush($stack);
        $this->straight = new \App\Rank\Straight($stack);
        $this->three = new \App\Rank\Three($stack);
        $this->two_pair = new \App\Rank\TwoPair($stack);
        $this->pair = new \App\Rank\Pair($stack);
    }

    /**
     * Supporting method for the $this->initialize method
     *
     * The method combines the two arrays entered into the $this->initialize method
     *
     * @param array $hand the first of two arrays conatining App\Poker\PokerCard objects; to be combined
     *
     * @param array $table the second of two arrays conatining App\Poker\PokerCard objects; to be combined
     */
    protected function makePile(array $hand, array $table): array
    {
        $final = $hand;

        foreach ($table as $card) {
            array_push($final, $card);
        }

        return $final;
    }

    /**
     * Method for returning the result of the ranking process; done by $this->initialize
     */
    public function result(): array
    {
        if ($this->royal_flush->result()) {
            return [10, "Royal Flush"];
        } elseif ($this->straight_flush->result()) {
            return [9, "Straight Flush"];
        } elseif ($this->four->result()) {
            return [8, "Four of a Kind"];
        } elseif ($this->full_house->result()) {
            return [7, "Full House"];
        } elseif ($this->flush->result()) {
            return [6, "Flush"];
        } elseif ($this->straight->result()) {
            return [5, "Straight"];
        } elseif ($this->three->result()) {
            return [4, "Three of a Kind"];
        } elseif ($this->two_pair->result()) {
            return [3, "Two Pair"];
        } elseif ($this->pair->result()) {
            return [2, "Pair"];
        } else {
            return [1, "High Card"];
        }
    }
}
