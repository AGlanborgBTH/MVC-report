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

    public function __construct()
    {
        $this->bool = false;
    }

    public function assert($stack, $num): bool
    {
        foreach($stack as $card) {
            $this->adduce($card, $stack, $num);
        }

        return $this->bool;
    }

    protected function adduce($card, $stack, $num) {
        $final = 0;

        foreach($stack as $stack_card) {
            if ($stack_card->get_pattern() == $card->get_pattern()) {
                $final += 1;
            }
        }

        if ($final == $num) {
            $this->bool = true;
        }
    }
}