<?php
declare(strict_types=1);
require_once('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$app_debug = "";
$db_host = "";
$db_user = "";
$db_pass = "";
$db_name = "";
$dotenv->safeload();
if (!array_key_exists('APP_DEBUG', $_ENV)){
    throw new Exception("Missing APP_DEBUG environment variable");
}
$app_debug = $_ENV['APP_DEBUG'];
if ($app_debug === true){
    // load database variable from .env
    if (!array_key_exists('DB_HOST', $_ENV)){
      throw new Exception("Missing DB_HOST environment variable");
    }
    $db_host = $_ENV["DB_HOST"];
    if (!array_key_exists('DB_USERNAME', $_ENV)){
      throw new Exception("Missing DB_USERNAME environment variable");
    }
    $db_user = $_ENV["DB_USERNAME"];
    if (!array_key_exists('DB_PASSWORD', $_ENV)){
      throw new Exception("Missing DB_PASSWORD environment variable");
    }
    $db_pass = $_ENV["DB_PASSWORD"];
    if (!array_key_exists('DB_DATABASE', $_ENV)){
      throw new Exception("Missing DB_DATABASE environment variable");
    }
    $db_name = $_ENV["DB_DATABASE"];
} else {
    // parse database varaibles from cleardb url
    if (!array_key_exists('CLEARDB_DATABASE_URL', $_ENV)){
        throw new Exception("Missing CLEARDB_DATABASE_URL environment variable");
    }
    $url = parse_url($_ENV["CLEARDB_DATABASE_URL"]);
    if (!array_key_exists('host', $url)){
      throw new Exception("Missing 'host' in database url");
    }
    $db_host = $url["host"];
    if (!array_key_exists('user', $url)){
      throw new Exception("Missing 'user' in database url");
    }
    $db_user = $url["user"];
    if (!array_key_exists('user', $password)){
      throw new Exception("Missing 'password' in database url");
    }
    $db_pass = $url["pass"];
    if (!array_key_exists('user', $path)){
      throw new Exception("Missing 'path' in database url");
    }
    $db_name = substr($url["path"], 1);
}

(new LampSite\NoCache())->generate_header();

// Create welcome message
echo "<h1>" . (new LampSite\Hello())->message() . "</h1>";

// Initalise database
$database = new LampSite\Database($db_host, $db_user, $db_pass, $db_name);

// Connect to database
if ($database->connect()) {
  echo "<h2>Database connected successfully</h2>";
} else {
  echo "<h2>Failed to connect to database</h2>";
}
