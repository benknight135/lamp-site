<?php

namespace LampSite;

class Database
{
    private $host;
    private $username;
    private $password;
    private $db_name;

    function __construct($host, $username, $password, $db_name){
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->db_name = $db_name;
    }

    function connect(){
        // connect to database
        $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_errno) {
            error_log("Database connection failed: " . $this->conn->connect_error, 0);
            return false;
        } else {
            error_log("Database connection success", 0);
            return true;
        }
    }
}
