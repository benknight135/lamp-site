<?php

use LampSite\EnvLoad;
use PHPUnit\Framework\TestCase;

/**
 * @covers LampSite\Env
 */
class EnvLoadTest extends TestCase
{
    private $env;

    public function setUp(): void {
        $this->env = (EnvLoad::getInstance())->getEnv();
    }

    public function testVars(): void {
        $this->assertTrue(isset($this->env->app_debug));
        $this->assertTrue(isset($this->env->db_host));
        $this->assertTrue(isset($this->env->db_user));
        $this->assertTrue(isset($this->env->db_pass));
        $this->assertTrue(isset($this->env->db_name));
    }
}
