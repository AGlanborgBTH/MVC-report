<?php

namespace App\Assert;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

/**
 * AscendingTest is an method for testing the App\Assert\Ascending class
 */
class AscendingTest extends TestCase
{
    /**
     * method for testing if Ascending creates without fail and assigns bool value to property
     */
    public function testCreateAscending()
    {
        $ascending = new Ascending();

        $this->assertInstanceOf("\App\Assert\Ascending", $ascending);
        $this->assertFalse($ascending->bool);
    }

    /**
     * method for testing if the method assert returns true with high values
     */
    public function testAscendingAssertTrueHigh()
    {
        $ascending = new Ascending();
        $prime = new PokerCard(10, "S");

        $stack = [
            new PokerCard("A", "S"),
            $prime,
            new PokerCard("J", "S"),
            new PokerCard("Q", "S"),
            new PokerCard("K", "S")
        ];

        $this->assertTrue($ascending->assert($stack, 5));
        $this->assertTrue($ascending->bool);
        $this->assertEquals($prime->get_points(), $ascending->value[0]);
    }

    /**
     * method for testing if the method assert returns true with low values
     */
    public function testAscendingAssertTrueLow()
    {
        $ascending = new Ascending();

        $stack = [
            new PokerCard("A", "S"),
            new PokerCard(2, "S"),
            new PokerCard(3, "S"),
            new PokerCard(4, "S"),
            new PokerCard(5, "S")
        ];

        $this->assertTrue($ascending->assert($stack, 5));
        $this->assertTrue($ascending->bool);
        $this->assertEquals(1, $ascending->value[0]);
    }

    /**
     * method for testing if the method assert returns false with wrong/failing values
     */
    public function testAscendingAssertFalse()
    {
        $ascending = new Ascending();
        $prime = new PokerCard("A", "S");

        $stack = [
            $prime,
            new PokerCard(3, "S"),
            new PokerCard(5, "S"),
            new PokerCard(7, "S"),
            new PokerCard(9, "S")
        ];

        $this->assertFalse($ascending->assert($stack, 5));
        $this->assertFalse($ascending->bool);
        $this->assertEmpty($ascending->value);
    }
}