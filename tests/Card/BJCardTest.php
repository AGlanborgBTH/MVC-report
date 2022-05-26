<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class BJCard
 */
class BJCardTest extends TestCase
{
    /**
     * Construct object and verify that the object is created
     */
    public function testCreateBJCard()
    {
        $card = new BJCard("A", "S");

        $this->assertInstanceOf("\App\Card\BJCard", $card);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties
     */
    public function testBJCardProperties()
    {
        $card = new BJCard("A", "S");

        $this->assertEquals(11, $card->getPoints());
        $this->assertEquals("A", $card->getValue());
        $this->assertEquals("S", $card->getPattern());
    }

    /**
     * Construct object and verify that the reduceA method changes
     * the points property
     */
    public function testBJCardReduceA()
    {
        $card = new BJCard("A", "S");

        $card->reduceA();

        $this->assertEquals(1, $card->getPoints());
    }
}