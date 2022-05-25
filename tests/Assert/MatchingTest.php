<?php

namespace App\Assert;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * MatchingTest is an method for testing the App\Assert\Matching class
 */
class MatchingTest extends TestCase
{
    /**
     * method for testing if Matching creates without fail and assigns bool value to property
     */
    public function testCreateMatching()
    {
        $matching = new Matching();

        $this->assertInstanceOf("\App\Assert\Matching", $matching);
        $this->assertFalse($matching->bool);
    }

    /**
     * method for testing if the method assert returns true with right/working values
     */
    public function testMatchingAssertTrue()
    {
        $matching = new Matching();

        $stack = [
            new PokerCard("A", "S"),
            new PokerCard("A", "H"),
            new PokerCard("J", "S"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $this->assertTrue($matching->assert($stack, 2));
        $this->assertTrue($matching->bool);
        $this->assertEquals($matching->value, 14);
    }

    /**
     * method for testing if the method assert returns false with wrong/failing values
     */
    public function testMatchingAssertFalse()
    {
        $matching = new Matching();

        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S"),
            new PokerCard("J", "S"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $this->assertFalse($matching->assert($stack, 2));
        $this->assertFalse($matching->bool);
    }
}