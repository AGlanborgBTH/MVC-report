<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class StraightTest extends TestCase
{
    public function testCreateStraight()
    {
        $straight = new Straight([]);

        $this->assertInstanceOf("\App\Rank\Straight", $straight);
    }

    public function testStraightAssertTrue()
    {
        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S"),
            new PokerCard("J", "S"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $straight = new Straight($stack);

        $this->assertTrue($straight->result($stack));
    }

    public function testStraightAssertFalse()
    {
        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(2, "S"),
            new PokerCard("J", "S"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $straight = new Straight($stack);

        $this->assertFalse($straight->result($stack));
    }
}