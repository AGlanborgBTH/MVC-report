<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DeckWith2Jokers
 */
class DeckWith2JokersTest extends TestCase
{
    /**
     * Construct object and verify that the object is created
     */
    public function testCreateDeckWith2Jokers()
    {
        $deck = new DeckWith2Jokers();

        $this->assertInstanceOf("\App\Card\DeckWith2Jokers", $deck);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties
     */
    public function testDeckWith2JokersProperties()
    {
        $deck = new DeckWith2Jokers();

        $this->assertNotEmpty($deck->ordered);
        $this->assertNotEmpty($deck->pile);
    }
}
