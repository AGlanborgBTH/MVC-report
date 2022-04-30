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

        $this->assertEquals($card->get_points(), 11);
        $this->assertEquals($card->get_value(), "A");
        $this->assertEquals($card->get_pattern(), "S");
    }

    /**
     * Construct object and verify that the reduce_a method changes
     * the points property
     */
    public function testBJCardReduceA()
    {
        $card = new BJCard("A", "S");

        $card->reduce_a();

        $this->assertEquals($card->get_points(), 1);
    }
}