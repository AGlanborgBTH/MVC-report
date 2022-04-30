<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class BJDeck
 */
class BJDeckTest extends TestCase
{
    /**
     * Construct object and verify that the object is created
     */
    public function testCreateBJDeck()
    {
        $deck = new BJDeck("A", "S");

        $this->assertInstanceOf("\App\Card\BJDeck", $deck);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties
     */
    public function testBJDeckProperties()
    {
        $deck = new BJDeck();

        $this->assertNotEmpty($deck->ordered);
        $this->assertNotEmpty($deck->pile);
    }
}