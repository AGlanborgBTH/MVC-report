<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Assert;

class Matching
{
    public bool $bool;

    public int $value;

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
            $final = 0;

            foreach($stack as $second) {
                if ($prime->get_points() == $second->get_points()) {
                    $final += 1;
                }
            }

            if ($final == $num) {
                $this->bool = true;
                $this->value = $prime->get_points();
            }
        }
    }
}