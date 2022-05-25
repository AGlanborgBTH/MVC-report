<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class PairTest extends TestCase
{
    public function testCreatePair()
    {
        $pair = new Pair([]);

        $this->assertInstanceOf("\App\Rank\Pair", $pair);
    }

    public function testPairAssertTrue()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(1, "H"),
            new PokerCard(11, "S"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $pair = new Pair($stack);

        $this->assertTrue($pair->result($stack));
    }

    public function testPairAssertFalse()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(10, "S"),
            new PokerCard(11, "S"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $pair = new Pair($stack);

        $this->assertFalse($pair->result($stack));
    }
}