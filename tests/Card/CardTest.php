<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card
 */
class CardTest extends TestCase
{
    /**
     * Construct object and verify that the object is created
     */
    public function testCreateCard()
    {
        $card = new Card("A", "S");

        $this->assertInstanceOf("\App\Card\Card", $card);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties
     */
    public function testCardProperties()
    {
        $deck = new Card("A", "S");

        $this->assertEquals("A", $deck->getValue());
        $this->assertEquals("S", $deck->getPattern());
    }
}