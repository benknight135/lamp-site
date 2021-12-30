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
        $this->_createTableIfDiffOrMissing(
            "ClickCounts",
            "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user VARCHAR(30) NOT NULL,
            count INT(6) NOT NULL"
        );
        $this->_tableGetSchema("ClickCounts");
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

    private function _createTableIfDiffOrMissing($table_name, $table_schema): bool{
        if (!$this->isConnected()){
            throw new Exception("Database is not connected!");
        }
        if (!$this->_tableExists($table_name)){
            $sql = "CREATE TABLE " . $table_name . " ";
            $sql = $sql . "(" . $table_schema . ") IF NOT EXISTS;";
            error_log($sql, 0);
            $res = $this->_conn->query($sql);
            if ($res === false){
                error_log($this->_conn->error, 0);
            } else {
                error_log("table creation success", 0);
            }
            return $res;
        }
        return false;
    }

    private function _tableExists($table_name): bool{
        if (!$this->isConnected()){
            throw new Exception("Database is not connected!");
        }
        $sql = "SELECT * FROM information_schema.tables ";
        $sql = $sql . "WHERE table_schema = '" . $this->db_name . "' ";
        $sql = $sql . "AND table_name = '" . $table_name . "' LIMIT 1;";
        $res = $this->_conn->query($sql);
        return $res->num_rows > 0;
    }

    private function _tableGetSchema($table_name): string{
        if (!$this->isConnected()){
            throw new Exception("Database is not connected!");
        }
        $sql = "SELECT * FROM information_schema.tables ";
        $sql = $sql . "WHERE table_schema = '" . $this->db_name . "' ";
        $sql = $sql . "AND table_name = '" . $table_name . "';";
        error_log($sql, 0);
        $res = $this->_conn->query($sql);
        if ($res === False){
            error_log($this->_conn->error, 0);
            return "";
        }
        if ($res->num_rows <= 0) {
            error_log("SQL query returned no results", 0);
            return "";
        }
        $schema = "";
        while($row = $res->fetch_assoc()) {
            error_log(array_keys($row), 0);
        }
    }

    private function _tableDiffSchema($table, $schema): bool {
        $current_schema = $this->_tableGetSchema($table);
        return strcmp($current_schema, $schema);
    }

    public function getCount(): int {
        return 0;
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
