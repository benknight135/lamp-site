<?php
declare(strict_types=1);
require_once('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$app_debug = "";
$db_host = "";
$db_user = "";
$db_pass = "";
$db_name = "";
try{
    $dotenv->load();
    $dotenv->required("APP_DEBUG");
} catch (Dotenv\Exception\InvalidPathException $e){
    // .env is missing when in production environment
    error_log("Missing .env file. Assuming production environment.", 0);
}
if (!array_key_exists('APP_DEBUG', $_ENV)){
    throw new Exception("Missing APP_DEBUG environment variable");
}
$app_debug = $_ENV['APP_DEBUG'];
if ($app_debug){
    // load database variable from .env
    $dotenv->required([
        "DB_HOST", "DB_USERNAME",
        "DB_PASSWORD", "DB_DATABASE"
    ]);
    $db_host = $_ENV["DB_HOST"];
    $db_user = $_ENV["DB_USERNAME"];
    $db_pass = $_ENV["DB_PASSWORD"];
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
