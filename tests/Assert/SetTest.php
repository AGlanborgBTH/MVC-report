<?php

namespace App\Assert;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * SetTest is an method for testing the App\Assert\Set class
 */
class SetTest extends TestCase
{
    /**
     * method for testing if Set creates without fail and assigns bool value to property
     */
    public function testCreateSet()
    {
        $set = new Set();

        $this->assertInstanceOf("\App\Assert\Set", $set);
        $this->assertFalse($set->bool);
    }

    /**
     * method for testing if the method assert returns true with right/working values
     */
    public function testSetAssertTrue()
    {
        $set = new Set();

        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(1, "H"),
            new PokerCard(1, "C"),
            new PokerCard(2, "S"),
            new PokerCard(2, "H")
        ];

        $this->assertTrue($set->assert($stack, 3, 2));
        $this->assertTrue($set->bool);
        $this->assertEquals($set->value, [1, 2]);
    }

    /**
     * method for testing if the method assert returns false with wrong/failing values
     */
    public function testSetAssertFalse()
    {
        $set = new Set();

        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(1, "H"),
            new PokerCard(2, "S"),
            new PokerCard(2, "H"),
            new PokerCard(3, "S")
        ];

        $this->assertFalse($set->assert($stack, 3, 2));
        $this->assertFalse($set->bool);
        $this->assertEmpty($set->value);
    }
}