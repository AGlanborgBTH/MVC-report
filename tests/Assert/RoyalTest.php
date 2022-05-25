<?php

namespace App\Assert;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class RoyalTest extends TestCase
{
    public function testCreateRoyal()
    {
        $royal = new Royal();

        $this->assertInstanceOf("\App\Assert\Royal", $royal);
        $this->assertFalse($royal->bool);
    }

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