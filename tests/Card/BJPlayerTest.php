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

        $this->assertEquals(0, $player->getState());
        $this->assertEquals(0, $player->getPoints());
    }

    /**
     * Construct object and verify that the setState method changes
     * the state property
     */
    public function testBJPlayerSetState()
    {
        $player = new BJPlayer();

        $player->setState(10);

        $this->assertEquals(10, $player->getState());
    }

    /**
     * Construct object and verify that the setPoints method does not
     * change the points propery if the hand propery does not contain
     * any card objects
     */
    public function testBJPlayerSetPointsZero()
    {
        $player = new BJPlayer();

        $player->setPoints();

        $this->assertEquals(0, $player->getPoints());
    }

    /**
     * Construct object and verify that the setPoints method changes
     * the points propety when the hand property has a card object in
     * itself
     */
    public function testBJPlayerSetPointsLTMax()
    {
        $player = new BJPlayer();
        $deck = new BJDeck();

        $player->addCard($deck->draw());

        $player->setPoints();

        $this->assertNotEquals(0, $player->getPoints());
    }

    /**
     * Construct object and verify that the setPoints method changes
     * the points propety when the hand property has a card object in
     * itself
     */
    public function testBJPlayerSetPointsGTMax()
    {
        $player = new BJPlayer();
        $spade = new BJCard("K", "S");
        $heart = new BJCard("K", "H");
        $club = new BJCard("K", "C");

        $player->addCard($spade);
        $player->addCard($heart);
        $player->addCard($club);

        $player->setPoints();

        $this->assertEquals(30, $player->getPoints());
    }

    /**
     * Construct object and verify that the setPoints method changes
     * the points earned when the total sum is greater than 21 and
     * the hand property contains an ace-card
     */
    public function testBJPlayerSetPointsOneAce()
    {
        $player = new BJPlayer();
        $ace = new BJCard("A", "S");
        $six = new BJCard("6", "H");
        $nine = new BJCard("9", "C");

        $player->addCard($ace);
        $player->addCard($six);
        $player->addCard($nine);

        $player->setPoints();

        $this->assertEquals(16, $player->getPoints());
    }

    /**
     * Construct object and verify that the setPoints method changes
     * the point-value of only one ace card when two are drawn
     */
    public function testBJPlayerSetPointsTwoAce()
    {
        $player = new BJPlayer();
        $spade = new BJCard("A", "S");
        $heart = new BJCard("A", "H");

        $player->addCard($spade);
        $player->addCard($heart);

        $player->setPoints();

        $this->assertEquals(12, $player->getPoints());
    }
}