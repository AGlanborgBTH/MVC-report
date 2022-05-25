<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * PairTest is an class for testing the App\Rank\Pair class
 */
class PairTest extends TestCase
{
    /**
     * method for testing if Pair creates without fail
     */
    public function testCreatePair()
    {
        $pair = new Pair([]);

        $this->assertInstanceOf("\App\Rank\Pair", $pair);
    }

    /**
     * method for testing if the method result returns true with right/working values
     */
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

    /**
     * method for testing if the method result returns false with wrong/failing values
     */
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