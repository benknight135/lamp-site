<?php

use LampSite\Database;
use PHPUnit\Framework\TestCase;

/**
 * @covers LampSite\Database
 */
class DatabaseTest extends TestCase
{
    protected $database;

    public function setUp(): void {
        $this->database = new Database();
    }

    public function testConnection(): void {
        $this->assertTrue($this->database->connect());
    }
}
