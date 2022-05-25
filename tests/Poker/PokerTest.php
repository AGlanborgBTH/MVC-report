<?php

namespace App\Rank;

use App\Poker\Poker;
use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class PokerTest extends TestCase
{
    public function testCreatePoker()
    {
        $poker = new Poker;

        $this->assertInstanceOf("\App\Poker\Poker", $poker);
    }

    public function testPokerRecieveBet()
    {
        $poker = new Poker;

        $poker->recieve_bet(300);

        $this->assertEquals($poker->bet, 300);
        $this->assertEquals($poker->phase, 1);
    }

    public function testPokerFlop()
    {
        $poker = new Poker;

        $this->assertEmpty($poker->player->hand);
        $this->assertEmpty($poker->dealer->hand);
        $this->assertEmpty($poker->table->hand);

        $poker->flop();

        $this->assertNotEmpty($poker->player->hand);
        $this->assertNotEmpty($poker->dealer->hand);
        $this->assertNotEmpty($poker->table->hand);
    }

    public function testPokerFold()
    {
        $poker = new Poker;

        $poker->fold();

        $this->assertEquals($poker->phase, 2);
    }

    public function testPokercall()
    {
        $poker = new Poker;

        $bet = 300;

        $this->assertEmpty($poker->table->hand);

        $poker->recieve_bet($bet);
        $poker->call();

        $this->assertNotEmpty($poker->table->hand);
        $this->assertEquals($poker->phase, 3);
        $this->assertEquals($poker->bet, $bet * 2);
    }

    public function testPokerComapreRanksWin()
    {
        $poker = new Poker;

        $poker->player->hand = [
            new PokerCard(1, "S"),
            new PokerCard(2, "S"),
            new PokerCard(3, "S"),
            new PokerCard(4, "S"),
            new PokerCard(5, "S")
        ];

        $poker->dealer->hand = [
            new PokerCard(1, "H"),
            new PokerCard(10, "H"),
            new PokerCard(3, "H"),
            new PokerCard(4, "H"),
            new PokerCard(5, "H")
        ];

        $poker->table->hand = [
            new PokerCard(1, "C")
        ];

        $poker->rank_player();
        $poker->rank_dealer();
        $poker->compare_ranks();

        $this->assertNotEmpty($poker->player_hand_rank);
        $this->assertNotEmpty($poker->dealer_hand_rank);
        $this->assertEquals($poker->phase, 6);
    }

    public function testPokerComapreRanksLoose()
    {
        $poker = new Poker;

        $poker->player->hand = [
            new PokerCard(1, "S"),
            new PokerCard(10, "S"),
            new PokerCard(3, "S"),
            new PokerCard(4, "S"),
            new PokerCard(5, "S")
        ];

        $poker->dealer->hand = [
            new PokerCard(1, "H"),
            new PokerCard(2, "H"),
            new PokerCard(3, "H"),
            new PokerCard(4, "H"),
            new PokerCard(5, "H")
        ];

        $poker->table->hand = [
            new PokerCard(1, "C")
        ];

        $poker->rank_player();
        $poker->rank_dealer();
        $poker->compare_ranks();

        $this->assertNotEmpty($poker->player_hand_rank);
        $this->assertNotEmpty($poker->dealer_hand_rank);
        $this->assertEquals($poker->phase, 4);
    }
}