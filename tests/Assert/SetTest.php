<?php

namespace App\Assert;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    public function testCreateSet()
    {
        $set = new Set();

        $this->assertInstanceOf("\App\Assert\Set", $set);
        $this->assertFalse($set->bool);
    }

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