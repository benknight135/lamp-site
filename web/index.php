<?php
declare(strict_types=1);
require_once('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo $_ENV['SQL_SERVER'] . "\n";
echo $_SERVER['SQL_SERVER'] . "\n";

$hello = new LampSite\Hello();
$hello_msg = $hello->message();
$hello_header = "<h1>$hello_msg</h1>";
echo $hello_header;


// $servername = "localhost";
// $username = "root";
// $password = "";

// // Create connection
// $conn = new mysqli($servername, $username, $password);

// // Check connection
// if ($conn->connect_error) {
// die("Connection failed: " . $conn->connect_error);
// }
// echo "<h2>Connected successfully</h2>";
