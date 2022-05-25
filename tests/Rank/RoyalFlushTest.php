<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class RoyalFlushTest extends TestCase
{
    public function testCreateRoyalFlush()
    {
        $Royal = new RoyalFlush([]);

        $this->assertInstanceOf("\App\Rank\RoyalFlush", $Royal);
    }

    public function testRoyalFlushAssertTrue()
    {
        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S"),
            new PokerCard("J", "S"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $Royal = new RoyalFlush($stack);

        $this->assertTrue($Royal->result($stack));
    }

    public function testRoyalFlushAssertFalseGrouping()
    {
        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S"),
            new PokerCard("J", "H"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $Royal = new RoyalFlush($stack);

        $this->assertFalse($Royal->result($stack));
    }

    public function testRoyalFlushAssertFalseRoyal()
    {
        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(9, "S"),
            new PokerCard("J", "S"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $Royal = new RoyalFlush($stack);

        $this->assertFalse($Royal->result($stack));
    }
}