<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class FourTest extends TestCase
{
    public function testCreateFour()
    {
        $four = new Four([]);

        $this->assertInstanceOf("\App\Rank\Four", $four);
    }

    public function testFourAssertTrue()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(1, "H"),
            new PokerCard(1, "C"),
            new PokerCard(1, "D"),
            new PokerCard(13, "S")
        ];

        $four = new Four($stack);

        $this->assertTrue($four->result($stack));
    }

    public function testFourAssertFalse()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(10, "S"),
            new PokerCard(11, "S"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $four = new Four($stack);

        $this->assertFalse($four->result($stack));
    }
}