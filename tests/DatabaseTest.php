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
    private $env;

    public function setUp(): void {
        $this->env = new Env();
        $this->env->load();
        $this->database = new Database(
            $this->env->db_host, $this->env->db_user,
            $this->env->db_pass, $this->env->db_name);
    }

    public function testConnection(): void {
        $this->assertTrue($this->database->connect());
    }
}
