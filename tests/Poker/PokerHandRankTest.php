<?php

namespace App\Rank;

use App\Poker\PokerHandRank;
use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class PokerHandRankTest extends TestCase
{
    public function testCreatePokerHandRank()
    {
        $poker = new PokerHandRank;

        $this->assertInstanceOf("\App\Poker\PokerHandRank", $poker);
    }

    public function testPokerHandRankRoyalFlush()
    {
        $poker = new PokerHandRank;

        $hand = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S")
        ];

        $table = [
            new PokerCard("A", "H"),
            new PokerCard(10, "H"),
            new PokerCard("J", "H"),
            new PokerCard("Q", "H"),
            new PokerCard("K", "H")
        ];

        $poker->initialize($hand, $table);

        $this->assertEquals($poker->result(), [10, "Royal Flush"]);
    }

    public function testPokerHandRankStraightFlush()
    {
        $poker = new PokerHandRank;

        $hand = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S")
        ];

        $table = [
            new PokerCard("A", "H"),
            new PokerCard(2, "H"),
            new PokerCard(3, "H"),
            new PokerCard(4, "H"),
            new PokerCard(5, "H")
        ];

        $poker->initialize($hand, $table);

        $this->assertEquals($poker->result(), [9, "Straight Flush"]);
    }


    public function testPokerHandRankFourOfAKind()
    {
        $poker = new PokerHandRank;

        $hand = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S")
        ];

        $table = [
            new PokerCard("A", "H"),
            new PokerCard("A", "C"),
            new PokerCard("A", "D"),
            new PokerCard(12, "H"),
            new PokerCard(13, "H")
        ];

        $poker->initialize($hand, $table);

        $this->assertEquals($poker->result(), [8, "Four of a Kind"]);
    }

    public function testPokerHandRankFullHouse()
    {
        $poker = new PokerHandRank;

        $hand = [
            new PokerCard("A", "S"),
            new PokerCard("A", "H")
        ];

        $table = [
            new PokerCard(10, "S"),
            new PokerCard(10, "H"),
            new PokerCard(10, "C"),
            new PokerCard("Q", "H"),
            new PokerCard("K", "H")
        ];

        $poker->initialize($hand, $table);

        $this->assertEquals($poker->result(), [7, "Full House"]);
    }

    public function testPokerHandRankFlush()
    {
        $poker = new PokerHandRank;

        $hand = [
            new PokerCard("A", "S"),
            new PokerCard(3, "S")
        ];

        $table = [
            new PokerCard(5, "H"),
            new PokerCard(7, "H"),
            new PokerCard(9, "H"),
            new PokerCard("J", "H"),
            new PokerCard("K", "H")
        ];

        $poker->initialize($hand, $table);

        $this->assertEquals($poker->result(), [6, "Flush"]);
    }

    public function testPokerHandRankStraight()
    {
        $poker = new PokerHandRank;

        $hand = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S")
        ];

        $table = [
            new PokerCard("A", "H"),
            new PokerCard(2, "S"),
            new PokerCard(3, "H"),
            new PokerCard(4, "H"),
            new PokerCard(5, "H")
        ];

        $poker->initialize($hand, $table);

        $this->assertEquals($poker->result(), [5, "Straight"]);
    }

    public function testPokerHandRankThreeOfAKind()
    {
        $poker = new PokerHandRank;

        $hand = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S")
        ];

        $table = [
            new PokerCard("A", "H"),
            new PokerCard("A", "C"),
            new PokerCard(2, "H"),
            new PokerCard(3, "H"),
            new PokerCard(4, "H")
        ];

        $poker->initialize($hand, $table);

        $this->assertEquals($poker->result(), [4, "Three of a Kind"]);
    }

    public function testPokerHandRankTwoPair()
    {
        $poker = new PokerHandRank;

        $hand = [
            new PokerCard("A", "S"),
            new PokerCard(10, "S")
        ];

        $table = [
            new PokerCard("A", "H"),
            new PokerCard(10, "H"),
            new PokerCard(3, "C"),
            new PokerCard(5, "C"),
            new PokerCard(7, "C")
        ];

        $poker->initialize($hand, $table);

        $this->assertEquals($poker->result(), [3, "Two Pair"]);
    }

    public function testPokerHandRankPair()
    {
        $poker = new PokerHandRank;

        $hand = [
            new PokerCard("A", "S"),
            new PokerCard("A", "H")
        ];

        $table = [
            new PokerCard(2, "H"),
            new PokerCard(3, "H"),
            new PokerCard("J", "C"),
            new PokerCard("Q", "C"),
            new PokerCard("K", "C")
        ];

        $poker->initialize($hand, $table);

        $this->assertEquals($poker->result(), [2, "Pair"]);
    }

    public function testPokerHandRankHighCard()
    {
        $poker = new PokerHandRank;

        $hand = [
            new PokerCard("A", "S"),
            new PokerCard(3, "S")
        ];

        $table = [
            new PokerCard(5, "H"),
            new PokerCard(7, "H"),
            new PokerCard(9, "C"),
            new PokerCard("J", "C"),
            new PokerCard("K", "C")
        ];

        $poker->initialize($hand, $table);

        $this->assertEquals($poker->result(), [1, "High Card"]);
    }
}