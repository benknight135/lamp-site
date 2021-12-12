<?php
declare(strict_types=1);
require_once('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Create welcome message
$hello = new LampSite\Hello();
$hello_msg = $hello->message();
$hello_header = "<h1>$hello_msg</h1>";
echo $hello_header;

// Setup connection to mysql server
$host = $_ENV['DB_HOST'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

// Create connection
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
echo "<h2>Database connected successfully</h2>";
