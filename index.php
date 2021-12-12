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

echo "<h3>\$_ENV['APP_DEBUG']: " . $_ENV['APP_DEBUG'] . "</h3>";
echo "<h3>getenv('APP_DEBUG'): " . getenv("APP_DEBUG") . "</h3>";


// // Setup connection to mysql server
// $host = $_ENV['DB_HOST'];
// $username = $_ENV['DB_USERNAME'];
// $password = $_ENV['DB_PASSWORD'];

// // Create connection
// $conn = new mysqli($host, $username, $password);

// // Check connection
// if ($conn->connect_error) {
// die("Connection failed: " . $conn->connect_error);
// }
// echo "<h2>Database connected successfully</h2>";
