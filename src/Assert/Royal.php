<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Assert;

class Royal
{
    public bool $bool;

    public function __construct()
    {
        $this->bool = false;
    }

    public function assert($stack): bool
    {
        $this->adduce($stack);

        return $this->bool;
    }

    protected function adduce($stack) {
        $royal = ["A", 10, "J", "Q", "K"];

        foreach ($stack as $card) {
            foreach ($royal as $roy) {
                if ($card->get_value() == $roy) {
                    $royal = array_diff($royal, [$roy]);
                }
            }
        }

        if ($royal == []) {
            $this->bool = true;
        }
    }
}