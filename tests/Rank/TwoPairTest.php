<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class TwoPairTest extends TestCase
{
    public function testCreateTwoPair()
    {
        $Two = new TwoPair([]);

        $this->assertInstanceOf("\App\Rank\TwoPair", $Two);
    }

    public function testTwoPairAssertTrue()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(1, "H"),
            new PokerCard(11, "S"),
            new PokerCard(11, "H"),
            new PokerCard(13, "S")
        ];

        $Two = new TwoPair($stack);

        $this->assertTrue($Two->result($stack));
    }

    public function testTwoPairAssertFalse()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(10, "S"),
            new PokerCard(11, "S"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $Two = new TwoPair($stack);

        $this->assertFalse($Two->result($stack));
    }
}