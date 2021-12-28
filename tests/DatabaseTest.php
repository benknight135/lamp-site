<?php

declare(strict_types=1);
require_once('vendor/autoload.php');

use LampSite\Database;
use PHPUnit\Framework\TestCase;

/**
 * @covers LampSite\Database
 */
class DatabaseTest extends TestCase
{
    private $database;

    public function setUp(): void {
        // TODO: find better way to load this file
        // this is needed as .env file loading doesn't work in
        // github actions???? 
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
        $dotenv->load();
        error_log( print_r($_ENV, TRUE) );
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
