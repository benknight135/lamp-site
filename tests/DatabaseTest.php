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
        error_log( print_r($_ENV, TRUE) );
        error_log( print_r($_SERVER, TRUE) );
        $db_host = $_SERVER["DB_HOST"];
        $db_user = $_SERVER["DB_USERNAME"];
        $db_pass = $_SERVER["DB_PASSWORD"];
        $db_name = $_SERVER["DB_DATABASE"];
        $this->database = new Database(
            $db_host, $db_user, $db_pass, $db_name);
    }

    public function testConnection(): void {
        $this->assertTrue($this->database->connect());
    }
}
