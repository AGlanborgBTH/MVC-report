<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Assert;

class Set
{
    public bool $bool;

    public array $value = array();

    public function __construct()
    {
        $this->bool = false;
    }

    public function assert($stack, $large, $small): bool
    {
        $this->adduce($stack, $large, $small);

        return $this->bool;
    }

    protected function adduce($stack, $large, $small) {
        $prime = $this->identify($stack, $large);

        if ($prime[0]) {
            $second = $this->identify($stack, $small, $prime[1]);

            if ($second[0]) {
                $this->bool = true;
                $this->value = [$prime[1], $second[1]];
            }
        }
    }

    protected function identify(array $stack, int $num, int $large = null) {
        $is_value = null;
        $is_true = false;

        foreach($stack as $prime) {
            $count = 0;

            foreach($stack as $second) {
                if ($prime->get_points() == $second->get_points() and $prime->get_points() != $large) {
                    $count += 1;
                }
            }

            if ($count == $num) {
                $is_true = true;
                $is_value = $prime->get_points();
                break;
            }
        }

        return [$is_true, $is_value];
    }
}