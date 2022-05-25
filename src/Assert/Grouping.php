<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Assert;

class Grouping
{
    public bool $bool;

    public array $value;

    public function __construct()
    {
        $this->bool = false;
    }

    public function assert(array $stack, int $num): bool
    {
        $this->adduce($stack, $num);

        return $this->bool;
    }

    protected function adduce(array $stack, int $num): void
    {
        foreach($stack as $prime) {
            $final = 0;
            $arr = [];

            foreach($stack as $second) {
                if ($prime->get_pattern() == $second->get_pattern()) {
                    $final += 1;
                    array_push($arr, $second);
                }
            }

            if ($final >= $num) {
                $this->bool = true;
                $this->value = $arr;
                break;
            }
        }
    }
}