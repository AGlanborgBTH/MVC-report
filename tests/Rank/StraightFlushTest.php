<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class StraightFlushTest extends TestCase
{
    public function testCreateStraightFlush()
    {
        $straight = new StraightFlush([]);

        $this->assertInstanceOf("\App\Rank\StraightFlush", $straight);
    }

    public function testStraightFlushAssertTrue()
    {
        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S"),
            new PokerCard("J", "S"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $straight = new StraightFlush($stack);

        $this->assertTrue($straight->result($stack));
    }

    public function testStraightFlushAssertFalseGrouping()
    {
        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S"),
            new PokerCard("J", "H"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $straight = new StraightFlush($stack);

        $this->assertFalse($straight->result($stack));
    }

    public function testStraightFlushAssertFalseAscending()
    {
        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(2, "S"),
            new PokerCard("J", "S"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $straight = new StraightFlush($stack);

        $this->assertFalse($straight->result($stack));
    }
}