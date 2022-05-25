<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * TwoPairTest is an class for testing the App\Rank\TwoPair class
 */
class TwoPairTest extends TestCase
{
    /**
     * method for testing if TwoPair creates without fail
     */
    public function testCreateTwoPair()
    {
        $Two = new TwoPair([]);

        $this->assertInstanceOf("\App\Rank\TwoPair", $Two);
    }

    /**
     * method for testing if the method result returns true with right/working values
     */
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

    /**
     * method for testing if the method result returns false with wrong/failing values
     */
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