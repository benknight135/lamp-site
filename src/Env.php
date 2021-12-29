<?php

namespace LampSite;

class Env
{
    public $app_debug;
    public $db_host;
    public $db_user;
    public $db_pass;
    public $db_name;

    function __construct(){
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
        $this->app_debug = "";
        $this->db_host = "";
        $this->db_user = "";
        $this->db_pass = "";
        $this->db_name = "";
        $dotenv->safeload();
        if (!array_key_exists('APP_DEBUG', $_ENV)){
            throw new Exception("Missing APP_DEBUG environment variable");
        }
        $this->app_debug = $_ENV['APP_DEBUG'];
        if ($this->app_debug === 'true'){
            // load database variable from .env
            if (!array_key_exists('DB_HOST', $_ENV)){
            throw new Exception("Missing DB_HOST environment variable");
            }
            $this->db_host = $_ENV["DB_HOST"];
            if (!array_key_exists('DB_USERNAME', $_ENV)){
            throw new Exception("Missing DB_USERNAME environment variable");
            }
            $this->db_user = $_ENV["DB_USERNAME"];
            if (!array_key_exists('DB_PASSWORD', $_ENV)){
            throw new Exception("Missing DB_PASSWORD environment variable");
            }
            $this->db_pass = $_ENV["DB_PASSWORD"];
            if (!array_key_exists('DB_DATABASE', $_ENV)){
            throw new Exception("Missing DB_DATABASE environment variable");
            }
            $this->db_name = $_ENV["DB_DATABASE"];
        } else {
            // parse database varaibles from cleardb url
            if (!array_key_exists('CLEARDB_DATABASE_URL', $_ENV)){
                throw new Exception("Missing CLEARDB_DATABASE_URL environment variable");
            }
            $url = parse_url($_ENV["CLEARDB_DATABASE_URL"]);
            if (!array_key_exists('host', $url)){
            throw new Exception("Missing 'host' in database url");
            }
            $this->db_host = $url["host"];
            if (!array_key_exists('user', $url)){
            throw new Exception("Missing 'user' in database url");
            }
            $this->db_user = $url["user"];
            if (!array_key_exists('pass', $url)){
            throw new Exception("Missing 'pass' in database url");
            }
            $this->db_pass = $url["pass"];
            if (!array_key_exists('path', $url)){
            throw new Exception("Missing 'path' in database url");
            }
            $this->db_name = substr($url["path"], 1);
        }
    }
}
