<?php

namespace App\Assert;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * RoyalTest is an method for testing the App\Assert\Royal class
 */
class RoyalTest extends TestCase
{
    /**
     * method for testing if Royal creates without fail and assigns bool value to property
     */
    public function testCreateRoyal()
    {
        $royal = new Royal();

        $this->assertInstanceOf("\App\Assert\Royal", $royal);
        $this->assertFalse($royal->bool);
    }

    /**
     * method for testing if the method assert returns true with right/working values
     */
    public function testRoyalAssertTrue()
    {
        $royal = new Royal();

        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S"),
            new PokerCard("J", "S"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $this->assertTrue($royal->assert($stack));
        $this->assertTrue($royal->bool);
    }

    /**
     * method for testing if the method assert returns false with wrong/failing values
     */
    public function testRoyalAssertFalse()
    {
        $royal = new Royal();

        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(9, "S"),
            new PokerCard("J", "S"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $this->assertFalse($royal->assert($stack));
        $this->assertFalse($royal->bool);
    }
}