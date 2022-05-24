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

    public function __construct()
    {
        $this->bool = false;
    }

    public function assert($stack, $num): bool
    {
        $this->adduce($stack, $num);

        return $this->bool;
    }

    protected function adduce($stack, $num) {
        foreach($stack as $prime) {
            $count = $num;
            $final = 0;

            while ($count != 0) {
                foreach($stack as $second) {
                    if ($prime->get_points() == $second->get_points() + $count) {
                        $final += 1;
                        break;
                    }
                }
                $count -= 1;
            }

            if ($final == $num) {
                $this->bool = true;
                break;
            }
        }
    }
}