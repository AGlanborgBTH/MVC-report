<?php

namespace App\Rank;

use App\Poker\PokerCard;

use PHPUnit\Framework\TestCase;

class FlushTest extends TestCase
{
    public function testCreateFlush()
    {
        $flush = new Flush([]);

        $this->assertInstanceOf("\App\Rank\Flush", $flush);
    }

    public function testFlushAssertTrue()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(10, "S"),
            new PokerCard(11, "S"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $flush = new Flush($stack);

        $this->assertTrue($flush->result($stack));
    }

    public function testFlushAssertFalse()
    {
        $stack = [
            new PokerCard(1, "S"),
            new PokerCard(10, "S"),
            new PokerCard(11, "H"),
            new PokerCard(12, "S"),
            new PokerCard(13, "S")
        ];

        $flush = new Flush($stack);

        $this->assertFalse($flush->result($stack));
    }
}