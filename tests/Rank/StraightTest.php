<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * StraightTest is an class for testing the App\Rank\Straight class
 */
class StraightTest extends TestCase
{
    /**
     * method for testing if Straight creates without fail
     */
    public function testCreateStraight()
    {
        $straight = new Straight([]);

        $this->assertInstanceOf("\App\Rank\Straight", $straight);
    }

    /**
     * method for testing if the method result returns true with right/working values
     */
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

    /**
     * method for testing if the method result returns false with wrong/failing values
     */
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