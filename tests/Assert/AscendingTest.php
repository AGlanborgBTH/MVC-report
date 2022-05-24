<?php

namespace App\Assert;

use PHPUnit\Framework\TestCase;

class AscendingTest extends TestCase
{
    public function testCreateAscending()
    {
        $ascending = new Ascending();

        $this->assertInstanceOf("\App\Assert\Ascending", $ascending);
    }
}