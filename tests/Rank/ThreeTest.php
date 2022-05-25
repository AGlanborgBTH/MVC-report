<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class ThreeTest extends TestCase
{
    public function testCreateThree()
    {
        $three = new Three([]);

        $this->assertInstanceOf("\App\Rank\Three", $three);
    }

    public function testThreeAssertTrue()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(1, "H"),
            new PokerCard(1, "C"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $three = new Three($stack);

        $this->assertTrue($three->result($stack));
    }

    public function testThreeAssertFalse()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(10, "S"),
            new PokerCard(11, "S"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $three = new Three($stack);

        $this->assertFalse($three->result($stack));
    }
}