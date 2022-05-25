<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * FourTest is an class for testing the App\Rank\Four class
 */
class FourTest extends TestCase
{
    /**
     * method for testing if Four creates without fail
     */
    public function testCreateFour()
    {
        $four = new Four([]);

        $this->assertInstanceOf("\App\Rank\Four", $four);
    }

    /**
     * method for testing if the method result returns true with right/working values
     */
    public function testFourAssertTrue()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(1, "H"),
            new PokerCard(1, "C"),
            new PokerCard(1, "D"),
            new PokerCard(13, "S")
        ];

        $four = new Four($stack);

        $this->assertTrue($four->result($stack));
    }

    /**
     * method for testing if the method result returns false with wrong/failing values
     */
    public function testFourAssertFalse()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(10, "S"),
            new PokerCard(11, "S"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $four = new Four($stack);

        $this->assertFalse($four->result($stack));
    }
}