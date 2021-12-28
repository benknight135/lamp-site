<?php

namespace LampSite;

class Database
{
    private $host;
    private $username;
    private $password;
    private $db_name;

    function __construct(){
        // load environment varibles
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
        $dotenv->safeLoad();
        $dotenv->required("APP_DEBUG");
        if ($_ENV['APP_DEBUG'] == true){
            // load database variable from .env
            $dotenv->required([
                "DB_HOST", "DB_USERNAME",
                "DB_PASSWORD", "DB_DATABASE"
            ]);
            $this->host = $_ENV['DB_HOST'];
            $this->username = $_ENV['DB_USERNAME'];
            $this->password = $_ENV['DB_PASSWORD'];
            $this->db_name = $_ENV['DB_DATABASE'];
        } else {
            // parse database varaibles from cleardb url
            $dotenv->required("CLEARDB_DATABASE_URL");
            $url = parse_url($_ENV["CLEARDB_DATABASE_URL"]);
            $this->host = $url["host"];
            $this->username = $url["user"];
            $this->password = $url["pass"];
            $this->db_name = substr($url["path"], 1);
        }
    }

    function connect(){
        // connect to database
        $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_errno) {
            error_log("Failed to connect to database: " . $this->conn->connect_error, 0);
            return false;
        } else {
            return true;
        }
    }
}
