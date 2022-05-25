<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class FullHouseTest extends TestCase
{
    public function testCreateFullHouse()
    {
        $Full = new FullHouse([]);

        $this->assertInstanceOf("\App\Rank\FullHouse", $Full);
    }

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