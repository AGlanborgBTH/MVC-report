<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * StraightFlushTest is an class for testing the App\Rank\StraightFlush class
 */
class StraightFlushTest extends TestCase
{
    /**
     * method for testing if StraightFlush creates without fail
     */
    public function testCreateStraightFlush()
    {
        $straight = new StraightFlush([]);

        $this->assertInstanceOf("\App\Rank\StraightFlush", $straight);
    }

    /**
     * method for testing if the method result returns true with right/working values
     */
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

    /**
     * method for testing if the method result returns false with wrong/failing values
     */
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