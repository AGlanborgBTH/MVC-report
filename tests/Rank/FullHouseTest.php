<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * FullHouseTest is an class for testing the App\Rank\FullHouse class
 */
class FullHouseTest extends TestCase
{
    /**
     * method for testing if FullHouse creates without fail
     */
    public function testCreateFullHouse()
    {
        $Full = new FullHouse([]);

        $this->assertInstanceOf("\App\Rank\FullHouse", $Full);
    }

    /**
     * method for testing if the method result returns true with right/working values
     */
    public function testFullHouseAssertTrue()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(1, "H"),
            new PokerCard(1, "C"),
            new PokerCard(13, "S"),
            new PokerCard(13, "H")
        ];

        $Full = new FullHouse($stack);

        $this->assertTrue($Full->result($stack));
    }

    /**
     * method for testing if the method result returns false with wrong/failing values
     */
    public function testFullHouseAssertFalse()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(10, "S"),
            new PokerCard(11, "S"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $Full = new FullHouse($stack);

        $this->assertFalse($Full->result($stack));
    }
}