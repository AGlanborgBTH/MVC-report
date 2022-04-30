<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Deck
 */
class DeckTest extends TestCase
{
    /**
     * Construct object and verify that the object is created
     */
    public function testCreateDeck()
    {
        $deck = new Deck();

        $this->assertInstanceOf("\App\Card\Deck", $deck);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties
     */
    public function testDeckProperties()
    {
        $deck = new Deck();

        $this->assertNotEmpty($deck->ordered);
        $this->assertNotEmpty($deck->pile);
    }

    /**
     * Construct object and verify that the shuffle method creates
     * new pile array that contains the same cards in a different
     * order
     */
    public function testShuffle()
    {
        $deck = new Deck();

        $old = $deck->pile;
        $deck->shuffle();
        $new = $deck->pile;

        $this->assertContains($old[0], $new);
        $this->assertNotEquals($new, $old);
    }

    /**
     * Construct object and verify that the draw method removes the
     * last card in the deck and returns it
     */
    public function testDraw()
    {
        $deck = new Deck();

        $target = $deck->pile[count($deck->pile) - 1];
        $card = $deck->draw();

        $this->assertSame($target, $card);
        $this->assertNotContains($card, $deck->pile);
    }
}