<?php

/**
 * This file is a module containing the BJ class
 *
 * (c) Anton Glanborg <angb21@student.bth.se>
 */

namespace App\Poker;

use App\Poker\PokerPlayer;
use App\Poker\PokerDeck;
use App\Poker\PokerHandRank;

/**
 * Poker is an class made for playing virtual Poker
 */
class Poker
{
    /**
     * The $dealer property represents an dealer in the virtual Poker game
     * 
     * $dealer must be or child to an App\Poker\PokerPlayer
     *
     * @var object
     */
    public object $dealer;

    /**
     * The $player property represents an player in the virtual Poker game
     * 
     * $player must be or child to an App\Poker\PokerPlayer
     *
     * @var object
     */
    public object $player;

    /**
     * The $table property represents an table in the virtual Poker game
     * 
     * $table must be or child to an App\Poker\PokerPlayer
     *
     * @var object
     */
    public object $table;

    /**
     * The $deck property represents an deck in the virtual Poker game
     * 
     * $deck must be or child to an App\Poker\PokerDeck
     *
     * @var object
     */
    public object $deck;

    /**
     * The $phase property represents what phase the game currently is in
     * 
     * It is an optional feature for optimum UX
     * 
     * * 0 - Pre Game
     * * 1 - Bet Placed/Playing
     * * 2 - Folded
     * * 3 - Second Bet
     * * 4 - Loose
     * * 5 - Draw
     * * 6 - Win
     * 
     * @var int
     */
    public int $phase;

    /**
     * The $bet property represents an bet in the virtual Poker game
     *
     * @var int
     */
    public int $bet;

    /**
     * The $player_hand_rank property consists of an object, representing the value of the $player->hand property
     * 
     * $player_hand_rank must be or child to an App\Poker\PokerHandRank
     *
     * @var object
     */
    public object $player_hand_rank;

    /**
     * The $dealer_hand_rank property consists of an object, representing the value of the $dealer->hand property
     * 
     * $dealer_hand_rank must be or child to an App\Poker\PokerHandRank
     *
     * @var object
     */
    public object $dealer_hand_rank;

    /**
     * Constructing method for the class
     *
     * Calls the $this->reset method
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Method for reseting the Poker class' variables/properties
     */
    public function reset(): void
    {
        $this->dealer = new PokerPlayer;
        $this->player = new PokerPlayer;
        $this->table = new PokerPlayer;
        $this->deck = new PokerDeck;
        $this->player_hand_rank = new PokerHandRank;
        $this->dealer_hand_rank = new PokerHandRank;
        $this->phase = 0;
    }

    /**
     * Method for updating the $bet- and phase- (to 1) property
     * 
     * @param int $bet is the amount assigned to the $bet property
     */
    public function recieve_bet(int $bet): void
    {
        $this->bet = $bet;
        $this->phase = 1;
    }

    /**
     * Method for dealing App\Poker\PokerCard objects to $this->player, $this->dealer and $this->table properties
     * 
     * * 2 to $this->player->hand
     * * 2 to $this->dealer->hand
     * * 3 to $this->table->hand
     */
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

    /**
     * Method for changing the $this->phase property to 2
     */
    public function fold(): void
    {
        $this->phase = 2;
    }

    /**
     * Method for updating the $this->bet property to twice the amount and dealing App\Poker\PokerCard objects to $this->table property and updating $this->phase property to 3
     */
    public function call(): void
    {
        $this->bet = $this->bet * 2;
        $this->deck->draw();
        $this->table->add_card($this->deck->draw());
        $this->deck->draw();
        $this->table->add_card($this->deck->draw());
        $this->phase = 3;
    }

    /**
     * Method for ranking the $this->player->hand with the $this->player_hand_rank
     */
    public function rank_player(): void
    {
        $this->player_hand_rank->initialize($this->player->hand, $this->table->hand);
        $this->player->hand_rank = $this->player_hand_rank->result();
    }

    /**
     * Method for ranking the $this->dealer->hand with the $this->dealer_hand_rank
     */
    public function rank_dealer(): void
    {
        $this->dealer_hand_rank->initialize($this->dealer->hand, $this->table->hand);
        $this->dealer->hand_rank = $this->dealer_hand_rank->result();
    }

    /**
     * Final method for ending the game and comparing the $this->player->hand and $this->dealer->hand
     */
    public function compare_ranks(): void
    {
        if ($this->player->hand_rank < $this->dealer->hand_rank) {
            $this->phase = 4;
        } elseif ($this->player->hand_rank == $this->dealer->hand_rank) {
            $tie = new PokerTie;
            $this->phase = $tie->result($this->player_hand_rank, $this->dealer_hand_rank, $this->player->hand, $this->dealer->hand, $this->table->hand);
        } else {
            $this->phase = 6;
        }
    }
}
