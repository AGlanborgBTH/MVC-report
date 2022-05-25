<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * RoyalFlushTest is an class for testing the App\Rank\RoyalFlush class
 */
class RoyalFlushTest extends TestCase
{
    /**
     * method for testing if RoyalFlush creates without fail
     */
    public function testCreateRoyalFlush()
    {
        $Royal = new RoyalFlush([]);

        $this->assertInstanceOf("\App\Rank\RoyalFlush", $Royal);
    }

    /**
     * method for testing if the method result returns true with right/working values
     */
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

    /**
     * method for testing if the method result returns false with wrong/failing values
     */
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