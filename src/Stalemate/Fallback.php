<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

/**
 * $fallback is an class made for asserting wish the remaining cards of an App\Poker\PokerTie dispute
 */
class Fallback
{
    /**
     * Method for returning the result; wich of the arrays of App\Poker\PokerCard objects contain the highest valued cards
     * 
     * Method is based on the App\Poker\PokerTie class results
     * 
     * @param array $player the first of the arrays to be compared
     * 
     * @param array $dealer the second of the arrays to be compared
     * 
     * @param array $table an array containing cards; shared among $player and $dealer
     * 
     * @param mixed $points int or array of numbers for counting which card values are legal and not
     * 
     * @param int $num the amount of cards the $player and $dealer must find the highest of
     */
    public function result(array $player, array $dealer, array $table, mixed $points, int $num): int
    {
        if (is_array($points)) {
            $arr = $points;
        } else {
            $arr = [$points];
        }

        $final = 5;

        while ($num != 0) {
            $temp = $this->find($player, $dealer, $table, $arr);

            if ($temp[0] != 5) {
                $final = $temp[0];
                break;
            }

            array_push($arr, $temp[1]);
            $num -= 1;
        }

        return $final;
    }

    /**
     * Assisting method for $this->result for returning the result; wich of the arrays of App\Poker\PokerCard objects contain the highest valued cards
     * 
     * The method searches for the highest card among $player, $dealer and $table, and returns result
     * 
     * @param array $player the first of the arrays to be compared
     * 
     * @param array $dealer the second of the arrays to be compared
     * 
     * @param array $table an array containing cards; shared among $player and $dealer
     * 
     * @param array $arr int or array of numbers for counting which card values are legal and not
     */
    protected function find(array $player, array $dealer, array $table, array $arr): array
    {
        $final = [0, "table"];

        foreach($player as $card) {
            if (!in_array($card->get_points(), $arr) and $card->get_points() > $final[0]) {
                $final = [$card->get_points(), "player"];
            }
        }

        foreach($dealer as $card) {
            if (!in_array($card->get_points(), $arr) and $card->get_points() >= $final[0]) {
                if ($card->get_points() == $final[0]) {
                    $final = [$card->get_points(), "table"];
                } else {
                    $final = [$card->get_points(), "dealer"];
                }
            }
        }

        foreach($table as $card) {
            if (!in_array($card->get_points(), $arr) and $card->get_points() > $final[0]) {
                $final = [$card->get_points(), "table"];
            }
        }

        if ($final[1] == "player") {
            return [6, $final[0]];
        } elseif ($final[1] == "table") {
            return [5, $final[0]];
        } else {
            return [4, $final[0]];
        }
    }
}