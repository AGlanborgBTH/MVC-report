<?php

namespace App\Rank;

use App\Poker\PokerTie;
use App\Poker\Poker;
use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class PokerTieTest extends TestCase
{
    public function testCreatePokerTie()
    {
        $poker = new PokerTie;

        $this->assertInstanceOf("\App\Poker\PokerTie", $poker);
    }

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