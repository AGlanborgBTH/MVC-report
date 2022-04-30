<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class BJ
 */
class BJTest extends TestCase
{
    /**
     * Construct object and verify that the object is created
     */
    public function testCreateBJ()
    {
        $bj = new BJ(1, new BJDeck());

        $this->assertInstanceOf("\App\Card\Bj", $bj);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties
     */
    public function testBJProperties()
    {
        $bj = new BJ(1, new BJDeck());

        $this->assertIsObject($bj->dealer);
        $this->assertNotEmpty($bj->players);
        $this->assertNotEmpty($bj->deck);
    }

    /**
     * Construct object and verify that the dealer_draw method
     * adds a single object to the dealer property's hand-property
     */
    public function testBJDealerDraw()
    {
        $bj = new BJ(1, new BJDeck());

        $initial = count($bj->dealer->hand);

        $bj->dealer_draw();

        $this->assertNotEmpty($bj->dealer->hand);
        $this->assertEquals(count($bj->dealer->hand), $initial + 1);
    }

    /**
     * Construct object and verify that the dealer_draw_two method
     * adds two objects to the dealer property's hand-property
     */
    public function testBJDealerDrawTwo()
    {
        $bj = new BJ(1, new BJDeck());

        $initial = count($bj->dealer->hand);

        $bj->dealer_draw_two();

        $this->assertNotEmpty($bj->dealer->hand);
        $this->assertEquals(count($bj->dealer->hand), $initial + 2);
    }

    /**
     * Construct object and verify that the player_draw_two method
     * adds two objects to the player hand-property
     */
    public function testBJPlayerDrawTwo()
    {
        $bj = new BJ(1, new BJDeck());

        $initial = count($bj->players[0]->hand);

        $bj->player_draw_two(0);

        $this->assertNotEmpty($bj->players[0]->hand);
        $this->assertEquals(count($bj->players[0]->hand), $initial + 2);
    }

    /**
     * Construct object and verify that the player_draw_two method
     * adds two objects to the player hand-property
     */
    public function testBJPlayerDrawTwoMax()
    {
        $bj = new BJ(1, new BJDeck());

        $bj->deck->pile = array(new BJCard("A", "S"), new BJCard("K", "H"));

        $bj->player_draw_two(0);

        $this->assertEquals($bj->players[0]->get_state(), 4);
    }


    /**
     * Construct object and verify that the hit method add an extra
     * card object to the hand array-property to the player
     */
    public function testBJHit()
    {
        $bj = new BJ(1, new BJDeck());

        $initial = count($bj->players[0]->hand);

        $bj->hit();

        $this->assertEquals(count($bj->players[0]->hand), $initial + 1);
    }

    /**
     * Construct object and verify that the hit method add an extra
     * card object to the hand array-property to the player
     */
    public function testBJHitGTMax()
    {
        $bj = new BJ(1, new BJDeck());

        $bj->players[0]->hand = array(new BJCard(21, "S"));
        $bj->players[0]->set_state(0);

        $bj->hit();

        $this->assertEquals($bj->players[0]->get_state(), 2);
    }

    /**
     * Construct object and verify that the player_draw_two method
     * adds two objects to the player hand-property
     */
    public function testBJStand()
    {
        $bj = new BJ(2, new BJDeck());

        foreach ($bj->players as $player) {
            $player->hand = array(new BJCard(2, "S"));
            $player->set_state(0);
            $player->set_points();
        }

        $bj->stand();

        $this->assertEquals($bj->players[0]->get_state(), 1);
        $this->assertEquals($bj->players[1]->get_state(), 0);
    }

    /**
     * Construct object and verify that the player_draw_two method
     * adds two objects to the player hand-property
     */
    public function testBJContinueDealerState()
    {
        $bj = new BJ(1, new BJDeck());

        $bj->stand();

        $this->assertEquals($bj->dealer->get_state(), 0);

        $bj->continue();

        $this->assertEquals($bj->dealer->get_state(), 1);
    }
}