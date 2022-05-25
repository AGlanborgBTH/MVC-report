<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class PokerCardTest extends TestCase
{
    public function testCreatePokerCard()
    {
        $poker = new PokerCard(1, "S");

        $this->assertInstanceOf("\App\Poker\PokerCard", $poker);
    }

    public function testPokerCardDefineBlackString()
    {
        $poker = new PokerCard("A", "S");

        $this->assertEquals($poker->get_value(), "A");
        $this->assertEquals($poker->get_points(), 14);
        $this->assertEquals($poker->get_pattern(), "S");
        $this->assertEquals($poker->get_color(), "black");
    }

    public function testPokerCardDefineRedInt()
    {
        $poker = new PokerCard(1, "H");

        $this->assertEquals($poker->get_value(), 1);
        $this->assertEquals($poker->get_points(), 1);
        $this->assertEquals($poker->get_pattern(), "H");
        $this->assertEquals($poker->get_color(), "red");
    }
}