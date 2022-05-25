<?php

namespace App\Rank;

use App\Poker\PokerDeck;

use PHPUnit\Framework\TestCase;

class PokerDeckTest extends TestCase
{
    public function testCreatePokerDeck()
    {
        $poker = new PokerDeck;

        $this->assertInstanceOf("\App\Poker\PokerDeck", $poker);
    }

    public function testPokerDeckContent()
    {
        $poker = new PokerDeck;

        $this->assertIsArray($poker->ordered);
        $this->assertIsArray($poker->pile);
        $this->assertEquals(count($poker->ordered), 52);
        $this->assertEquals(count($poker->pile), 52);
    }
}