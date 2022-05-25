<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class Straight_flushTest extends TestCase
{
    public function testCreateStraightFlush()
    {
        $straight = new Straight_flush([]);

        $this->assertInstanceOf("\App\Rank\Straight_flush", $straight);
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

        $straight = new Straight_flush($stack);

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

        $straight = new Straight_flush($stack);

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

        $straight = new Straight_flush($stack);

        $this->assertFalse($straight->result($stack));
    }
}