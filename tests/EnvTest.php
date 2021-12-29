<?php

use LampSite\Env;
use PHPUnit\Framework\TestCase;

/**
 * @covers LampSite\Env
 */
class EnvTest extends TestCase
{
    private $env;

    public function setUp(): void {
        $this->env = new Env();
    }

    public function testLoad(): void {
        $this->env->load();
        $this->assertNotNull($this->env->app_debug);
        $this->assertNotNull($this->env->db_host);
        $this->assertNotNull($this->env->db_user);
        $this->assertNotNull($this->env->db_pass);
        $this->assertNotNull($this->env->db_name);
    }
}
