<?php

namespace App\Assert;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class GroupingTest extends TestCase
{
    public function testCreateGrouping()
    {
        $grouping = new Grouping();

        $this->assertInstanceOf("\App\Assert\Grouping", $grouping);
        $this->assertFalse($grouping->bool);
    }

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