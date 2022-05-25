<?php

namespace App\Rank;

use App\Poker\PokerTie;
use App\Poker\Poker;
use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * PokerTieTest is an class for testing the App\Poker\PokerTie class
 */
class PokerTieTest extends TestCase
{
    /**
     * method for testing if PokerTie creates without fail
     */
    public function testCreatePokerTie()
    {
        $poker = new PokerTie;

        $this->assertInstanceOf("\App\Poker\PokerTie", $poker);
    }

    /**
     * method for testing that the App\Poker\PokerTie method can return draw when containing two royal flush
     */
    public function testPokerTieRoyalFlush()
    {
        $poker = new Poker;

        $poker->player->hand = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S"),
            new PokerCard("J", "S"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $poker->dealer->hand = [
            new PokerCard("A", "H"),
            new PokerCard(10, "H"),
            new PokerCard("J", "H"),
            new PokerCard("Q", "H"),
            new PokerCard("K", "H")
        ];

        $poker->table->hand = [
            new PokerCard("A", "C")
        ];

        $poker->rank_player();
        $poker->rank_dealer();
        $poker->compare_ranks();

        $this->assertEquals($poker->phase, 5);
    }

    /**
     * method for testing that the App\Poker\PokerTie method can return draw when containing two straight flush
     */
    public function testPokerTieStraightFlush()
    {
        $poker = new Poker;

        $poker->player->hand = [
            new PokerCard("A", "S"),
            new PokerCard(2, "S"),
            new PokerCard(3, "S"),
            new PokerCard(4, "S"),
            new PokerCard(5, "S")
        ];

        $poker->dealer->hand = [
            new PokerCard("A", "H"),
            new PokerCard(2, "H"),
            new PokerCard(3, "H"),
            new PokerCard(4, "H"),
            new PokerCard(5, "H")
        ];

        $poker->table->hand = [
            new PokerCard("A", "C")
        ];

        $poker->rank_player();
        $poker->rank_dealer();
        $poker->compare_ranks();

        $this->assertEquals($poker->phase, 5);
    }

    /**
     * method for testing that the App\Poker\PokerTie method can return draw when containing two 'four of a kind'
     */
    public function testPokerTieFourOfAKind()
    {
        $poker = new Poker;

        $poker->player->hand = [
            new PokerCard("K", "S"),
            new PokerCard(2, "S")
        ];

        $poker->dealer->hand = [
            new PokerCard("K", "H"),
            new PokerCard(2, "H")
        ];

        $poker->table->hand = [
            new PokerCard("A", "S"),
            new PokerCard("A", "H"),
            new PokerCard("A", "C"),
            new PokerCard("A", "D"),
            new PokerCard(2, "C")
        ];

        $poker->rank_player();
        $poker->rank_dealer();
        $poker->compare_ranks();

        $this->assertEquals($poker->phase, 5);
    }

    /**
     * method for testing that the App\Poker\PokerTie method can return draw when containing two full house
     */
    public function testPokerTieFullHouse()
    {
        $poker = new Poker;

        $poker->player->hand = [
            new PokerCard("K", "S"),
            new PokerCard(2, "S")
        ];

        $poker->dealer->hand = [
            new PokerCard("K", "H"),
            new PokerCard(2, "H")
        ];

        $poker->table->hand = [
            new PokerCard("K", "C"),
            new PokerCard(2, "C"),
            new PokerCard(2, "D"),
            new PokerCard(3, "S"),
            new PokerCard(4, "S")
        ];

        $poker->rank_player();
        $poker->rank_dealer();
        $poker->compare_ranks();

        $this->assertEquals($poker->phase, 5);
    }

    /**
     * method for testing that the App\Poker\PokerTie method can return draw when containing two flush
     */
    public function testPokerTieFlush()
    {
        $poker = new Poker;

        $poker->player->hand = [
            new PokerCard("K", "C"),
            new PokerCard(2, "H")
        ];

        $poker->dealer->hand = [
            new PokerCard("K", "H"),
            new PokerCard(2, "C")
        ];

        $poker->table->hand = [
            new PokerCard(4, "S"),
            new PokerCard(6, "S"),
            new PokerCard(7, "S"),
            new PokerCard(8, "S"),
            new PokerCard(10, "S")
        ];

        $poker->rank_player();
        $poker->rank_dealer();
        $poker->compare_ranks();

        $this->assertEquals($poker->phase, 5);
    }

    /**
     * method for testing that the App\Poker\PokerTie method can return draw when containing two straight
     */
    public function testPokerTieStraight()
    {
        $poker = new Poker;

        $poker->player->hand = [
            new PokerCard("K", "S"),
            new PokerCard(2, "H")
        ];

        $poker->dealer->hand = [
            new PokerCard("K", "H"),
            new PokerCard(2, "S")
        ];

        $poker->table->hand = [
            new PokerCard(3, "S"),
            new PokerCard(4, "S"),
            new PokerCard(5, "S"),
            new PokerCard(6, "H"),
            new PokerCard(7, "H")
        ];

        $poker->rank_player();
        $poker->rank_dealer();
        $poker->compare_ranks();

        $this->assertEquals($poker->phase, 5);
    }

    /**
     * method for testing that the App\Poker\PokerTie method can return draw when containing two 'three of a kind'
     */
    public function testPokerTieThree()
    {
        $poker = new Poker;

        $poker->player->hand = [
            new PokerCard("K", "S"),
            new PokerCard(2, "H")
        ];

        $poker->dealer->hand = [
            new PokerCard("K", "H"),
            new PokerCard(2, "S")
        ];

        $poker->table->hand = [
            new PokerCard("K", "C"),
            new PokerCard("K", "D"),
            new PokerCard(5, "S"),
            new PokerCard(6, "H"),
            new PokerCard(7, "H")
        ];

        $poker->rank_player();
        $poker->rank_dealer();
        $poker->compare_ranks();

        $this->assertEquals($poker->phase, 5);
    }

    /**
     * method for testing that the App\Poker\PokerTie method can return draw when containing two royal hands
     */
    public function testPokerTieTwoPair()
    {
        $poker = new Poker;

        $poker->player->hand = [
            new PokerCard("K", "S"),
            new PokerCard(2, "H")
        ];

        $poker->dealer->hand = [
            new PokerCard("K", "H"),
            new PokerCard(2, "S")
        ];

        $poker->table->hand = [
            new PokerCard(2, "C"),
            new PokerCard("K", "C"),
            new PokerCard(5, "S"),
            new PokerCard(6, "H"),
            new PokerCard(7, "H")
        ];

        $poker->rank_player();
        $poker->rank_dealer();
        $poker->compare_ranks();

        $this->assertEquals($poker->phase, 5);
    }

    /**
     * method for testing that the App\Poker\PokerTie method can return draw when containing two pair
     */
    public function testPokerTiePair()
    {
        $poker = new Poker;

        $poker->player->hand = [
            new PokerCard("K", "S"),
            new PokerCard(2, "H")
        ];

        $poker->dealer->hand = [
            new PokerCard("K", "H"),
            new PokerCard(2, "S")
        ];

        $poker->table->hand = [
            new PokerCard(10, "C"),
            new PokerCard("K", "C"),
            new PokerCard(5, "S"),
            new PokerCard(6, "H"),
            new PokerCard(7, "H")
        ];

        $poker->rank_player();
        $poker->rank_dealer();
        $poker->compare_ranks();

        $this->assertEquals($poker->phase, 5);
    }

    /**
     * method for testing that the App\Poker\PokerTie method can return draw when containing two high cards
     */
    public function testPokerTieHighCard()
    {
        $poker = new Poker;

        $poker->player->hand = [
            new PokerCard("K", "S"),
            new PokerCard(2, "H")
        ];

        $poker->dealer->hand = [
            new PokerCard("K", "H"),
            new PokerCard(2, "S")
        ];

        $poker->table->hand = [
            new PokerCard(4, "C"),
            new PokerCard(6, "C"),
            new PokerCard(8, "S"),
            new PokerCard(10, "H"),
            new PokerCard("J", "H")
        ];

        $poker->rank_player();
        $poker->rank_dealer();
        $poker->compare_ranks();

        $this->assertEquals($poker->phase, 5);
    }
}