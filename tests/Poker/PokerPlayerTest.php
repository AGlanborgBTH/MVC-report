<?php

namespace App\Rank;

use App\Poker\PokerPlayer;
use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * PokerPlayerTest is an class for testing the App\Poker\PokerPlayer class
 */
class PokerPlayerTest extends TestCase
{
    /**
     * method for testing if PokerPlayer creates without fail
     */
    public function testCreatePokerPlayer()
    {
        $poker = new PokerPlayer;

        $this->assertInstanceOf("\App\Poker\PokerPlayer", $poker);
    }

    /**
     * method for testing that the hand property is empty when created
     */
    public function testPokerPlayerEmpty()
    {
        $poker = new PokerPlayer;

        $this->assertEmpty($poker->hand);
    }

    /**
     * method for testing that the hand property conatins cards when created
     */
    public function testPokerPlayerFull()
    {
        $card = new PokerCard("A", "S");
        $poker = new PokerPlayer([$card, new PokerCard("A", "H")]);

        $this->assertNotEmpty($poker->hand);
        $this->assertContains($card, $poker->hand);
    }

    /**
     * method for testing that the hand property gains an card when useing addCard method
     */
    public function testPokerPlayerAddCard()
    {
        $card = new PokerCard("A", "S");
        $poker = new PokerPlayer();

        $poker->addCard($card);

        $this->assertNotEmpty($poker->hand);
        $this->assertContains($card, $poker->hand);
    }
}