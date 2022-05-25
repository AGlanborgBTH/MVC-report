<?php

namespace App\Assert;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * GroupingTest is an method for testing the App\Assert\Grouping class
 */
class GroupingTest extends TestCase
{
    /**
     * method for testing if Grouping creates without fail and assigns bool value to property
     */
    public function testCreateGrouping()
    {
        $grouping = new Grouping();

        $this->assertInstanceOf("\App\Assert\Grouping", $grouping);
        $this->assertFalse($grouping->bool);
    }

    /**
     * method for testing if the method assert returns true with right/working values
     */
    public function testGroupingAssertTrue()
    {
        $grouping = new Grouping();

        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S"),
            new PokerCard("J", "S"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $this->assertTrue($grouping->assert($stack, 5));
        $this->assertTrue($grouping->bool);
        $this->assertEquals($grouping->value, $stack);
    }

    /**
     * method for testing if the method assert returns false with wrong/failing values
     */
    public function testGroupingAssertFalse()
    {
        $grouping = new Grouping();

        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S"),
            new PokerCard("J", "H"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $this->assertFalse($grouping->assert($stack, 5));
        $this->assertFalse($grouping->bool);
    }
}