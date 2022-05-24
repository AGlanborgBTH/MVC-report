<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Poker;

use App\Poker\PokerPlayer;
use App\Poker\PokerDeck;

class Poker
{
    public object $dealer;

    public object $player;

    public object $table;

    public object $deck;

    /**
     * * 0 - Pre Game
     * * 1 - Bet Placed/Playing
     * * 2 - Folded
     * * 3 - Second Bet
     * * 4 - Loose
     * * 5 - Draw
     * * 6 - Win
     */
    public int $phase;

    public int $bet;

    public object $hand_rank;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->dealer = new PokerPlayer;
        $this->player = new PokerPlayer;
        $this->table = new PokerPlayer;
        $this->deck = new PokerDeck;
        $this->phase = 0;
    }

    public function recieve_bet(int $bet): void
    {
        $this->bet = $bet;
        $this->phase = 1;
    }

    public function flop(): void
    {
        $this->player->add_card($this->deck->draw());
        $this->dealer->add_card($this->deck->draw());
        $this->player->add_card($this->deck->draw());
        $this->dealer->add_card($this->deck->draw());
        $this->deck->draw();
        $this->table->add_card($this->deck->draw());
        $this->table->add_card($this->deck->draw());
        $this->table->add_card($this->deck->draw());
    }

    public function river(): void
    {
        $this->deck->draw();
        $this->table->add_card($this->deck->draw());
        $this->deck->draw();
        $this->table->add_card($this->deck->draw());
    }

    public function fold(): void
    {
        $this->phase = 2;
    }

    public function call(): void
    {
        $this->bet = $this->bet * 2;
        $this->table->add_card($this->deck->draw());
        $this->table->add_card($this->deck->draw());
        $this->phase = 3;
    }

    public function rank_player(): void
    {
        $rank = new \App\Poker\PokerHandRank($this->player->hand, $this->table->hand);
        $this->player->hand_rank = $rank->result();
    }

    public function rank_dealer(): void
    {
        $rank = new \App\Poker\PokerHandRank($this->player->hand, $this->table->hand);
        $this->dealer->hand_rank = $rank->result();
    }

    public function compare_ranks(): void
    {
        if ($this->player->hand_rank < $this->dealer->hand_rank) {
            $this->phase = 4;
        } elseif ($this->player->hand_rank == $this->dealer->hand_rank) {
            $this->phase = 5;
        } else {
            $this->phase = 6;
        }
    }
}