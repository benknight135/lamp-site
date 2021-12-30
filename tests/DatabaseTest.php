<?php

use LampSite\Database;
use PHPUnit\Framework\TestCase;

/**
 * @covers LampSite\Database
 */
class DatabaseTest extends TestCase
{
    private $database;

    public function setUp(): void {
        $this->database = Database::getInstance();
    }

    public function testConnection(): void {
        $this->assertTrue($this->database->isConnected());
    }
}
