<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Assert;

class Ascending
{
    public bool $bool;

    public array $value = array();

    public function __construct()
    {
        $this->bool = false;
    }

    public function assert($stack, $num): bool
    {
        foreach($stack as $prime) {
            $this->adduce($prime, $stack, $num);
        }

        return $this->bool;
    }

    protected function adduce($prime, $stack, $num) {
        $count = $num;
        $final = 0;

        while ($count != 0) {
            if ($prime->get_points() + $count == 14) {
                $final += $this->identify(1, $stack);
            } else {
                $final += $this->identify($prime->get_points() + $count, $stack);
            }
            $count -= 1;
        }

        if ($final == $num) {
            $this->bool = true;
            array_push($this->value, $prime);
        }
    }

    protected function identify($value, $stack): int
    {
        $final = 0;

        foreach($stack as $second) {
            if ($second->get_points() == $value) {
                $final += 1;
                break;
            }
        }

        return $final;
    }
}