<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * FlushTest is an class for testing the App\Rank\Flush class
 */
class FlushTest extends TestCase
{
    /**
     * method for testing if Flush creates without fail
     */
    public function testCreateFlush()
    {
        $flush = new Flush([]);

        $this->assertInstanceOf("\App\Rank\Flush", $flush);
    }

    /**
     * method for testing if the method result returns true with right/working values
     */
    public function testFlushAssertTrue()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(10, "S"),
            new PokerCard(11, "S"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $flush = new Flush($stack);

        $this->assertTrue($flush->result($stack));
    }

    /**
     * method for testing if the method result returns false with wrong/failing values
     */
    public function testFlushAssertFalse()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(10, "S"),
            new PokerCard(11, "H"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $flush = new Flush($stack);

        $this->assertFalse($flush->result($stack));
    }
}