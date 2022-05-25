<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * ThreeTest is an class for testing the App\Rank\Three class
 */
class ThreeTest extends TestCase
{
    /**
     * method for testing if Three creates without fail
     */
    public function testCreateThree()
    {
        $three = new Three([]);

        $this->assertInstanceOf("\App\Rank\Three", $three);
    }

    /**
     * method for testing if the method result returns true with right/working values
     */
    public function testThreeAssertTrue()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(1, "H"),
            new PokerCard(1, "C"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $three = new Three($stack);

        $this->assertTrue($three->result($stack));
    }

    /**
     * method for testing if the method result returns false with wrong/failing values
     */
    public function testThreeAssertFalse()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(10, "S"),
            new PokerCard(11, "S"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $three = new Three($stack);

        $this->assertFalse($three->result($stack));
    }
}