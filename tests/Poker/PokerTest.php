<?php

namespace App\Rank;

use App\Poker\Poker;
use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * PokerTest is an class for testing the App\Poker\Poker class
 */
class PokerTest extends TestCase
{
    /**
     * method for testing if Poker creates without fail
     */
    public function testCreatePoker()
    {
        $poker = new Poker;

        $this->assertInstanceOf("\App\Poker\Poker", $poker);
    }

    /**
     * method for testing that the bet- and phase-property updates when using the recieve_bet method
     */
    public function testPokerRecieveBet()
    {
        $poker = new Poker;

        $poker->recieve_bet(300);

        $this->assertEquals($poker->bet, 300);
        $this->assertEquals($poker->phase, 1);
    }

    /**
     * method for testing that the player>-hand-, dealer->hand- and table->hand-property updates when using the flop method
     */
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

    /**
     * method for testing that the phase property updates when using the fold method
     */
    public function testPokerFold()
    {
        $poker = new Poker;

        $poker->fold();

        $this->assertEquals($poker->phase, 2);
    }

    /**
     * method for testing that the table->hand property updates when using the call method
     */
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

    /**
     * method for testing that the player_hand_rank-, dealer_hand_rank- and phase property updates when using the compare_ranks method with greater/loosing values/cards
     */
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

    /**
     * method for testing that the player_hand_rank-, dealer_hand_rank- and phase property updates when using the compare_ranks method with greater/winning values/cards
     */
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