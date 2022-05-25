<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * PokerCardTest is an class for testing the App\Poker\PokerCard class
 */
class PokerCardTest extends TestCase
{
    /**
     * method for testing if PokerCard creates without fail
     */
    public function testCreatePokerCard()
    {
        $poker = new PokerCard(1, "S");

        $this->assertInstanceOf("\App\Poker\PokerCard", $poker);
    }

    /**
     * method for testing if the the constructing method assigns right values when using strings and black pattern
     */
    public function testPokerCardDefineBlackString()
    {
        $poker = new PokerCard("A", "S");

        $this->assertEquals($poker->get_value(), "A");
        $this->assertEquals($poker->get_points(), 14);
        $this->assertEquals($poker->get_pattern(), "S");
        $this->assertEquals($poker->get_color(), "black");
    }

    /**
     * method for testing if the the constructing method assigns right values when using integer and red pattern
     */
    public function testPokerCardDefineRedInt()
    {
        $poker = new PokerCard(1, "H");

        $this->assertEquals($poker->get_value(), 1);
        $this->assertEquals($poker->get_points(), 1);
        $this->assertEquals($poker->get_pattern(), "H");
        $this->assertEquals($poker->get_color(), "red");
    }
}