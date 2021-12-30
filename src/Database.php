<?php
declare(strict_types = 1);

namespace LampSite;

class Database
{
    private static $_instance = NULL;

    private $_conn = NULL;
    private string $host;
    private string $username;
    private string $password;
    private string $db_name;
    
    public function __construct() {
        $env = (EnvLoad::getInstance())->getEnv();
        $this->host = $env->db_host;
        $this->username = $env->db_user;
        $this->password = $env->db_pass;
        $this->db_name = $env->db_name;
        $this->_connect();
    }

    private function _connect(): bool {
        if (!$this->isConnected()){
            $this->_conn = new \mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->_conn->connect_errno) {
                error_log("Database connection failed: " . $this->_conn->connect_error, 0);
                return false;
            }
            error_log("Database connection success", 0);
            return true;
        }
        error_log("Database already connected. Ignoring call to connect.", 0);
        return false;
    }

    public function isConnected(): bool {
        if (!isset($this->_conn)){
            return false;
        }
        return $this->_conn->ping();
    }

    public static function getInstance()
    {
        if (self::$_instance == null)
        {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }
}
