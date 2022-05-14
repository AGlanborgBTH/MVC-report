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
        $bj = new BJ(1);

        $this->assertInstanceOf("\App\Card\Bj", $bj);
    }

    /**
     * Construct object and verify that the object has the expected properties
     */
    public function testBJProperties()
    {
        $bj = new BJ(1);

        $this->assertIsObject($bj->dealer);
        $this->assertNotEmpty($bj->players);
        $this->assertNotEmpty($bj->deck);
    }

    /**
     * Construct object and verify that the dealer_draw_two method adds two objects to the dealer property's hand-property
     */
    public function testBJDealerDrawTwo()
    {
        $bj = new BJ(1);

        $initial = count($bj->dealer->hand);

        $bj->dealer_draw_two();

        $this->assertNotEmpty($bj->dealer->hand);
        $this->assertEquals($initial + 2, count($bj->dealer->hand));
    }

    /**
     * Construct object and verify that the player_draw_two method adds two objects to the player hand-property
     */
    public function testBJPlayerDrawTwo()
    {
        $bj = new BJ(1);

        $initial = count($bj->players[0]->hand);

        $bj->player_draw_two(0);

        $this->assertNotEmpty($bj->players[0]->hand);
        $this->assertEquals($initial + 2, count($bj->players[0]->hand));
    }

    /**
     * Construct object and verify that the player_draw_two method changes state to 4 when max points is reached
     */
    public function testBJPlayerDrawTwoMax()
    {
        $bj = new BJ(1);

        $bj->players[0]->hand = array();
        $bj->players[0]->set_state(0);
        $bj->players[0]->set_points();

        $bj->deck->pile = array(new BJCard("A", "S"), new BJCard("K", "H"));

        $bj->player_draw_two(0);

        $this->assertEquals(4,  $bj->players[0]->get_state());
    }


    /**
     * Construct object and verify that the hit method add an extra card object to the hand array-property to the player
     */
    public function testBJHit()
    {
        $bj = new BJ(1);

        $bj->players[0]->set_state(0);

        $initial = count($bj->players[0]->hand);

        $bj->hit();

        $this->assertEquals($initial + 1, count($bj->players[0]->hand));
    }

    /**
     * Construct object and verify that the hit method changes state to 1 when max points is reached
     */
    public function testBJHitMax()
    {
        $bj = new BJ(1);

        $bj->deck->pile = array(new BJCard("A", "S"));
        $bj->players[0]->hand = array(new BJCard("K", "S"));
        $bj->players[0]->set_state(0);

        $bj->hit();

        $this->assertEquals(1, $bj->players[0]->get_state());
    }

    /**
     * Construct object and verify that the hit method changes state to 2 when more than max points is reached
     */
    public function testBJHitGTMax()
    {
        $bj = new BJ(1);

        $bj->deck->pile = array(new BJCard("K", "C"));
        $bj->players[0]->hand = array(new BJCard("K", "S"), new BJCard("K", "H"));
        $bj->players[0]->set_state(0);

        $bj->hit();

        $this->assertEquals(2, $bj->players[0]->get_state());
    }

    /**
     * Construct object and verify that the stand method changes the the first player state to 1 from 0
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

        $this->assertEquals(1, $bj->players[0]->get_state());
        $this->assertEquals(0, $bj->players[1]->get_state());
    }

    /**
     * Construct object and verify that the Continue method changes the dealer state to 1 from 0 and that the method is able to act when continue is used for a second time
     */
    public function testBJContinueDealerState()
    {
        $bj = new BJ(1);

        $bj->stand();

        $this->assertEquals(0, $bj->dealer->get_state());

        $bj->continue();

        $this->assertEquals(1, $bj->dealer->get_state());

        $bj->continue();
    }
}