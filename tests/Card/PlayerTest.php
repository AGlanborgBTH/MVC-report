<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player
 */
class PlayerTest extends TestCase
{
    /**
     * Construct object and verify that the object is created
     */
    public function testCreatePlayer()
    {
        $person = new Player();

        $this->assertInstanceOf("\App\Card\Player", $person);
    }

    /**
     * Construct object and verify that the object has the expected
     * property
     */
    public function testPlayerProperties()
    {
        $person = new Player();

        $this->assertIsArray($person->hand);
    }

    /**
     * Construct object and verify that the add_card method adds
     * cards to the hand array-propertie
     */
    public function testAddCard()
    {
        $person = new Player();
        $deck = new Deck();

        $card = $deck->draw();

        $person->add_card($card);

        $this->assertNotEmpty($person->hand);
    }

    /**
     * Construct object and verify that the clear_hand method removes
     * all cards held in the hand array-property
     */
    public function testEmptyHand()
    {
        $person = new Player();
        $deck = new Deck();

        $card = $deck->draw();

        $person->add_card($card);
        $person->clear_hand();

        $this->assertEmpty($person->hand);
    }
}