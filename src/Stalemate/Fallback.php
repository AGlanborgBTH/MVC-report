<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Stalemate;

class Fallback
{
    public function result($player, $dealer, $table, $points, $num): int
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

    protected function find($player, $dealer, $table, $arr): array
    {
        $final = [0, "table"];

        foreach($player as $card) {
            if (!in_array(14, $arr) and $card->get_points() == 1) {
                $final = [14, "player"];
            } elseif (!in_array($card->get_points(), $arr) and $card->get_points() > $final[0]) {
                $final = [$card->get_points(), "player"];
            }
        }

        foreach($dealer as $card) {
            if (!in_array(14, $arr) and $card->get_points() == 1) {
                if ($final = [14, "player"]) {
                    $final = [14, "table"];
                } else {
                    $final = [14, "dealer"];
                }
            } elseif (!in_array($card->get_points(), $arr) != $arr and $card->get_points() > $final[0]) {
                $final = [$card->get_points(), "dealer"];
            }
        }

        foreach($table as $card) {
            if (!in_array($card->get_points(), $arr) != $arr and $card->get_points() > $final[0]) {
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