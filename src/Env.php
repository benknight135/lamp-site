<?php

namespace LampSite;

class Env
{
    public $app_debug;
    public $db_host;
    public $db_user;
    public $db_pass;
    public $db_name;

    function load(){
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
        $dotenv->safeload();
        if (!array_key_exists('APP_DEBUG', $_SERVER)){
            throw new Exception("Missing APP_DEBUG environment variable");
        }
        $this->app_debug = $_SERVER['APP_DEBUG'];
        if ($this->app_debug === 'true'){
            // load database variable from .env
            if (!array_key_exists('DB_HOST', $_SERVER)){
            throw new Exception("Missing DB_HOST environment variable");
            }
            $this->db_host = $_SERVER["DB_HOST"];
            if (!array_key_exists('DB_USERNAME', $_SERVER)){
            throw new Exception("Missing DB_USERNAME environment variable");
            }
            $this->db_user = $_SERVER["DB_USERNAME"];
            if (!array_key_exists('DB_PASSWORD', $_SERVER)){
            throw new Exception("Missing DB_PASSWORD environment variable");
            }
            $this->db_pass = $_SERVER["DB_PASSWORD"];
            if (!array_key_exists('DB_DATABASE', $_SERVER)){
            throw new Exception("Missing DB_DATABASE environment variable");
            }
            $this->db_name = $_SERVER["DB_DATABASE"];
        } else {
            // parse database varaibles from cleardb url
            if (!array_key_exists('CLEARDB_DATABASE_URL', $_SERVER)){
                throw new Exception("Missing CLEARDB_DATABASE_URL environment variable");
            }
            $url = parse_url($_SERVER["CLEARDB_DATABASE_URL"]);
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
