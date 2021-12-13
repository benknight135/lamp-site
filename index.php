<?php
declare(strict_types=1);
require_once('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

// Create welcome message
$hello = new LampSite\Hello();
$hello_msg = $hello->message();
$hello_header = "<h1>$hello_msg</h1>";
echo $hello_header;

$host = "";
$username = "";
$password = "";
$db_name = "";

if ($_ENV['APP_DEBUG'] == "true"){
  echo "<h3>Debugging: enabled</h3>";
  // Setup connection to mysql server
  $host = $_ENV['DB_HOST'];
  $username = $_ENV['DB_USERNAME'];
  $password = $_ENV['DB_PASSWORD'];
  $db_name = $_ENV['DB_DATABASE'];
} else {
  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
  $host = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db_name = substr($url["path"], 1);
}

echo "<h3>Server settings</h3>";
echo "<p>Host: $host</p>";
echo "<p>User: $username</p>";
echo "<p>Pass: $password</p>";
echo "<p>Database: $db_name</p>";

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
} else {
  echo "<h2>Database connected successfully</h2>";
}
