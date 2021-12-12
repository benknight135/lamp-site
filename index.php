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

if ($_ENV['APP_DEBUG'] == "true"){
    echo "<h3>Debugging: enabled</h3>";
}

// Setup connection to mysql server
$host = $_ENV['DB_HOST'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$db_name = $_ENV['DB_DATABASE'];
$use_ssl = $_ENV['MYSQL_SSL'];
$ssl_cert = $_ENV['MYSQL_SSL_CERT'];

echo "<h3>Server settings</h3>";
echo "<p>Host: $host</p>";
echo "<p>User: $username</p>";
echo "<p>Pass: $password</p>";
echo "<p>Database: $db_name</p>";
echo "<p>Use SSL: $use_ssl</p>";
echo "<p>SSL cert: $ssl_cert</p>";

if ($use_ssl == "true") {
    $certfile = fopen("ssl.crt.pem", "w") or die("Unable to open file!");
    fwrite($certfile, $ssl_cert);
    fclose($certfile);
}

// Create connection
echo "Started db connection<br>";
$conn = mysqli_init();
$timeout = 30;  /* thirty seconds for timeout */
if ($use_ssl == "true") {
    $conn->options( MYSQLI_OPT_CONNECT_TIMEOUT, $timeout ) || die( 'mysqli_options croaked: ' . $conn->error );
    mysqli_ssl_set($conn, NULL, NULL, "ssl.crt.pem", NULL, NULL);
    mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, NULL, MYSQLI_CLIENT_SSL);
} else {
    mysqli_real_connect($conn, $host, $username, $password, $db_name);
}

//If connection failed, show the error
if (mysqli_connect_errno()) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
} else {
    echo "<h2>Database connected successfully</h2>";
}