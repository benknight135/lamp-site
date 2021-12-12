<?php
require '../vendor/autoload.php';

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
