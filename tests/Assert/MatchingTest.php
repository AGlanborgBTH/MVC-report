<?php

namespace App\Assert;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class MatchingTest extends TestCase
{
    public function testCreateMatching()
    {
        $matching = new Matching();

        $this->assertInstanceOf("\App\Assert\Matching", $matching);
        $this->assertFalse($matching->bool);
    }

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