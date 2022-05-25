<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class Full_houseTest extends TestCase
{
    public function testCreateFullHouse()
    {
        $Full = new Full_house([]);

        $this->assertInstanceOf("\App\Rank\Full_house", $Full);
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

        $Full = new Full_house($stack);

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

        $Full = new Full_house($stack);

        $this->assertFalse($Full->result($stack));
    }
}