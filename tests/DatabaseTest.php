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
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
        $dotenv->load();
        $db_host = $_ENV["DB_HOST"];
        $db_user = $_ENV["DB_USERNAME"];
        $db_pass = $_ENV["DB_PASSWORD"];
        $db_name = $_ENV["DB_DATABASE"];
        $this->database = new Database(
            $db_host, $db_user, $db_pass, $db_name);
    }

    public function testConnection(): void {
        $this->assertTrue($this->database->connect());
    }
}
