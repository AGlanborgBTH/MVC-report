<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class BJPlayer
 */
class BJPlayerTest extends TestCase
{
    /**
     * Construct object and verify that the object is created
     */
    public function testCreateBJPlayer()
    {
        $player = new BJPlayer();

        $this->assertInstanceOf("\App\Card\BJPlayer", $player);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties
     */
    public function testBJPlayerProperties()
    {
        $player = new BJPlayer();

        $this->assertEquals(0, $player->get_state());
        $this->assertEquals(0, $player->get_points());
    }

    /**
     * Construct object and verify that the set_state method changes
     * the state property
     */
    public function testBJPlayerSetState()
    {
        $player = new BJPlayer();

        $player->set_state(10);

        $this->assertEquals(10, $player->get_state());
    }

    /**
     * Construct object and verify that the set_points method does not
     * change the points propery if the hand propery does not contain
     * any card objects
     */
    public function testBJPlayerSetPointsZero()
    {
        $player = new BJPlayer();

        $player->set_points();

        $this->assertEquals(0, $player->get_points());
    }

    /**
     * Construct object and verify that the set_points method changes
     * the points propety when the hand property has a card object in
     * itself
     */
    public function testBJPlayerSetPointsLTMax()
    {
        $player = new BJPlayer();
        $deck = new BJDeck();

        $player->add_card($deck->draw());

        $player->set_points();

        $this->assertNotEquals(0, $player->get_points());
    }

    /**
     * Construct object and verify that the set_points method changes
     * the points propety when the hand property has a card object in
     * itself
     */
    public function testBJPlayerSetPointsGTMax()
    {
        $player = new BJPlayer();
        $spade = new BJCard("K", "S");
        $heart = new BJCard("K", "H");
        $club = new BJCard("K", "C");

        $player->add_card($spade);
        $player->add_card($heart);
        $player->add_card($club);

        $player->set_points();

        $this->assertEquals(30, $player->get_points());
    }

    /**
     * Construct object and verify that the set_points method changes
     * the points earned when the total sum is greater than 21 and
     * the hand property contains an ace-card
     */
    public function testBJPlayerSetPointsOneAce()
    {
        $player = new BJPlayer();
        $ace = new BJCard("A", "S");
        $six = new BJCard("6", "H");
        $nine = new BJCard("9", "C");

        $player->add_card($ace);
        $player->add_card($six);
        $player->add_card($nine);

        $player->set_points();

        $this->assertEquals(16, $player->get_points());
    }

    /**
     * Construct object and verify that the set_points method changes
     * the point-value of only one ace card when two are drawn
     */
    public function testBJPlayerSetPointsTwoAce()
    {
        $player = new BJPlayer();
        $spade = new BJCard("A", "S");
        $heart = new BJCard("A", "H");

        $player->add_card($spade);
        $player->add_card($heart);

        $player->set_points();

        $this->assertEquals(12, $player->get_points());
    }
}