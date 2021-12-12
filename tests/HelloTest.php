<?php

use LampSite\Hello;
use PHPUnit\Framework\TestCase;

/**
 * @covers Hello
 */
class HelloTest extends TestCase
{
    protected $Hello;

    public function setUp(): void {
        $this->Hello = new Hello();
    }

    public function testHelloMessage(): void {
        $this->assertEquals("hello world", $this->Hello->message());
    }
}
