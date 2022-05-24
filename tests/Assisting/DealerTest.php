<?php

namespace App\Assisting;

use App\Card\BJ;
use App\Card\BJCard;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class BJ and Dealer
 */
class DealerTest extends TestCase
{
    /**
     * Construct object and verify that the object is created
     */
    public function testCreateDealer()
    {
        $dealer = new Dealer();

        $this->assertInstanceOf("\App\Assisting\Dealer", $dealer);
    }

    /**
     * Construct object and verify that the dealer_draw method adds an card to the dealers hand and updates points
     */
    public function testDealerDealerDraw()
    {
        $bj = new BJ(1);

        $bj->players[0]->set_state(0);
        $bj->dealer->hand = array(new BJCard("A", "S"));
        $bj->deck->pile = array(new BJCard("A", "H"));

        $bj->stand();

        $bj->continue();

        $this->assertEquals(11, $bj->dealer->get_points());

        $bj->continue();

        $this->assertEquals(2, count($bj->dealer->hand));
        $this->assertEquals(1, $bj->dealer->get_state());
        $this->assertEquals(12, $bj->dealer->get_points());
    }

    /**
     * Construct object and verify that the dealer_high method changes all player objects with state 1 to 4
     */
    public function testDealerHigh()
    {
        $bj = new BJ(1);

        $bj->players[0]->set_state(0);
        $bj->dealer->hand = array(new BJCard("K", "S"), new BJCard("K", "H"), new BJCard("K", "C"));

        $bj->stand();

        $bj->continue();

        $bj->continue();

        $this->assertEquals(4, $bj->players[0]->get_state());
        $this->assertEquals(2, $bj->dealer->get_state());
    }

    /**
     * Construct object and verify that the dealer_land method changes all player objects with state 1 to 2/3/4 when player loose/draw/win
     */
    public function testDealerLand()
    {
        $bj = new BJ(3);

        $bj->players[0]->hand = array(new BJCard("K", "S"), new BJCard("5", "S"));
        $bj->players[1]->hand = array(new BJCard("K", "H"), new BJCard("K", "C"));
        $bj->players[2]->hand = array(new BJCard("K", "D"), new BJCard("A", "S"));
        $bj->dealer->hand = array(new BJCard("Q", "S"), new BJCard("Q", "H"));

        foreach ($bj->players as $player) {
            $player->set_state(1);
            $player->set_points();
        }

        $bj->continue();

        $bj->continue();

        $this->assertEquals(2, $bj->players[0]->get_state());
        $this->assertEquals(3, $bj->players[1]->get_state());
        $this->assertEquals(4, $bj->players[2]->get_state());
        $this->assertEquals(2, $bj->dealer->get_state());
    }
}