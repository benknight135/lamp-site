<?php

use LampSite\Database;
use LampSite\Env;
use PHPUnit\Framework\TestCase;

/**
 * @covers LampSite\Database
 */
class DatabaseTest extends TestCase
{
    private $database;

    public function setUp(): void {
        // TODO find out why $_ENV doesn't work here
        $env = new Env();
        $this->database = new Database(
            $env->db_host, $env->db_user, $env->db_pass, $env->db_name);
    }

    public function testConnection(): void {
        $this->assertTrue($this->database->connect());
    }
}
