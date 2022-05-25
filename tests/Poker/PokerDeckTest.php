<?php

namespace App\Rank;

use App\Poker\PokerDeck;

use PHPUnit\Framework\TestCase;

/**
 * PokerDeckTest is an class for testing the App\Poker\PokerDeck class
 */
class PokerDeckTest extends TestCase
{
    /**
     * method for testing if PokerDeck creates without fail
     */
    public function testCreatePokerDeck()
    {
        $poker = new PokerDeck;

        $this->assertInstanceOf("\App\Poker\PokerDeck", $poker);
    }

    /**
     * method for testing if the constructing method assigns the right content to properties
     */
    public function testPokerDeckContent()
    {
        $poker = new PokerDeck;

        $this->assertIsArray($poker->ordered);
        $this->assertIsArray($poker->pile);
        $this->assertEquals(count($poker->ordered), 52);
        $this->assertEquals(count($poker->pile), 52);
    }
}