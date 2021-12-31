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
    private array $db_tables;
    
    public function __construct() {
        $env = (EnvLoad::getInstance())->getEnv();
        $this->host = $env->db_host;
        $this->username = $env->db_user;
        $this->password = $env->db_pass;
        $this->db_name = $env->db_name;

        $this->db_tables = array();
        array_push($this->db_tables, new DbTableUsers());

        $this->_connect();
        $this->_dropTable("users");
        $this->_createTables();
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

    private function _createTables(): bool {
        if (!$this->isConnected()){
            throw new \Exception("Database is not connected!");
        }
        $create_success = true;
        foreach ($this->db_tables as $db_table){
            $create_sql = $db_table->getCreateTableSql();
            $data_sql = $db_table->getFillDataSql();
            $table_name = $db_table->getName();
            if (!$this->_tableExists($table_name)){
                // create table if it doesn't already exist
                $res = $this->_conn->query($create_sql);
                if ($res === false){
                    error_log($this->_conn->error, 0);
                    $create_success = false;
                    break;
                }
                if ($data_sql !== ""){
                    $res = $this->_conn->query($data_sql);
                    if ($res === false){
                        error_log($this->_conn->error, 0);
                        $create_success = false;
                        break;
                    }
                }
            }
        }
        return $create_success;
    }

    private function _tableExists($table_name): bool{
        if (!$this->isConnected()){
            throw new \Exception("Database is not connected!");
        }
        $sql = "SELECT * FROM information_schema.tables ";
        $sql .= "WHERE table_schema = '" . $this->db_name . "' ";
        $sql .= "AND table_name = '" . $table_name . "' LIMIT 1;";
        $res = $this->_conn->query($sql);
        return $res->num_rows > 0;
    }

    private function _getTableSchema($table_name): string{
        if (!$this->isConnected()){
            throw new \Exception("Database is not connected!");
        }
        $sql = "SHOW CREATE TABLE " . $table_name . ";";
        $res = $this->_conn->query($sql);
        if ($res === False){
            error_log($this->_conn->error, 0);
            return "";
        }
        if ($res->num_rows <= 0) {
            error_log("SQL query returned no results", 0);
            return "";
        }
        if ($res->num_rows != 1) {
            error_log("SQL query requires exactly 1 result to match conditions", 0);
            return "";
        }
        $first_res = $res->fetch_assoc();
        $create_sql = $first_res["Create Table"];
        // remove new lines and tabs
        $create_sql = str_replace(array("\n", "\r", "\t"), '', $create_sql);
        // replace double or more spaces with single space
        $create_sql = preg_replace('/ +/', ' ', $create_sql);
        return $create_sql;
    }

    private function _dropTable($table_name): bool {
        if (!$this->isConnected()){
            throw new \Exception("Database is not connected!");
        }
        $sql = "DROP TABLE IF EXISTS " . $table_name . ";";
        $res = $this->_conn->query($sql);
        return $res;
    }

    public function incrementCount($username): bool {
        if (!$this->isConnected()){
            throw new \Exception("Database is not connected!");
        }
        $current_count = $this->getCount($username);
        if ($current_count < 0){
            return false;
        }
        return $this->setCount($username, $current_count + 1);
    }

    public function setCount($username, $count): bool {
        if (!$this->isConnected()){
            throw new \Exception("Database is not connected!");
        }
        $sql = "UPDATE `users` SET `click_count` = " . strval($count) . " WHERE `username` = '" . $username . "';";
        $res = $this->_conn->query($sql);
        if ($res !== true) {
            error_log($conn->error, 0);
        }
        return true;
    }

    public function getCount($username): int {
        if (!$this->isConnected()){
            throw new \Exception("Database is not connected!");
        }
        $sql = "SELECT * FROM `users` WHERE `username` = '" . $username . "';";
        $res = $this->_conn->query($sql);
        if ($res->num_rows <= 0) {
            error_log("SQL query returned no results", 0);
            return -1;
        }
        if ($res->num_rows != 1) {
            error_log("SQL query requires exactly 1 result to match conditions", 0);
            return -1;
        }
        $first_res = $res->fetch_assoc();
        $count_value = $first_res["click_count"];
        return intval($count_value);
    }

    public function isValidCredentials($username, $password){
        if (!$this->isConnected()){
            throw new \Exception("Database is not connected!");
        }
        $sql = "SELECT * FROM `users` WHERE `username` = '" . $username . "' AND `password` = '". $password . "';";
        $res = $this->_conn->query($sql);
        if ($res->num_rows <= 0) {
            error_log("SQL query returned no results", 0);
            return -1;
        }
        if ($res->num_rows != 1) {
            error_log("SQL query requires exactly 1 result to match conditions", 0);
            return -1;
        }
        return true;
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
