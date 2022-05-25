<?php

namespace App\Rank;

use App\Poker\PokerPlayer;
use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class PokerPlayerTest extends TestCase
{
    public function testCreatePokerPlayer()
    {
        $poker = new PokerPlayer;

        $this->assertInstanceOf("\App\Poker\PokerPlayer", $poker);
    }

    public function testPokerPlayerEmpty()
    {
        $poker = new PokerPlayer;

        $this->assertEmpty($poker->hand);
    }

    public function testPokerPlayerFull()
    {
        $card = new PokerCard("A", "S");
        $poker = new PokerPlayer([$card, new PokerCard("A", "H")]);

        $this->assertNotEmpty($poker->hand);
        $this->assertContains($card, $poker->hand);
    }

    public function testPokerPlayerAddCard()
    {
        $card = new PokerCard("A", "S");
        $poker = new PokerPlayer();

        $poker->add_card($card);

        $this->assertNotEmpty($poker->hand);
        $this->assertContains($card, $poker->hand);
    }

    public function testPokerPlayerRemoveCards()
    {
        $card = new PokerCard("A", "S");
        $poker = new PokerPlayer([$card, new PokerCard("A", "H")]);

        $poker->remove_cards();

        $this->assertEmpty($poker->hand);
        $this->assertNotContains($card, $poker->hand);
    }
}