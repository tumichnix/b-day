<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class BasicTest extends TestCase
{
    public function testTrueIsTrue()
    {
        $this->assertTrue(true);
        $this->assertTrue(true);
    }

    public function testFalseIsFalse()
    {
        $this->assertFalse(false);
        $this->assertFalse(false);
    }
}
