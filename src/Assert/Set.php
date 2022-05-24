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

    public array $values = array();

    public function __construct()
    {
        $this->bool = false;
    }

    public function assert($stack, $large, $small): bool
    {
        foreach($stack as $card) {
            array_push($this->values, $card->get_points());
        }

        $this->adduce($large, $small);

        return $this->bool;
    }

    protected function adduce($large, $small) {
        $prime = $this->identify($large);

        if ($prime[0]) {
            $second = $this->identify($small, $prime[1]);

            if ($second[0]) {
                $this->bool = true;
            }
        }
    }

    protected function identify(int $num, int $large = null) {
        $is_value = null;
        $is_true = false;

        foreach($this->values as $prime) {
            $count = 0;

            foreach($this->values as $second) {
                if ($prime == $second and $prime != $large) {
                    $count += 1;
                }
            }

            if ($count == $num) {
                $is_true = true;
                $is_value = $prime;
                break;
            }
        }

        return [$is_true, $is_value];
    }
}