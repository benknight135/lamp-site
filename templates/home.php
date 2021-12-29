<?php
require_once('../vendor/autoload.php');

$env = new \LampSite\Env();
$env->load();

echo '<link rel="shortcut icon" type="image/ico" href="/assets/images/favicon.ico"/>';

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

// Create welcome message
echo "<h1>Welcome to LAMP site</h1>";

// Initalise database
$database = new \LampSite\Database(
  $env->db_host, $env->db_user, $env->db_pass, $env->db_name);

// Connect to database
if ($database->connect()) {
  echo "<h2>Database connected successfully</h2>";
} else {
  echo "<h2>Failed to connect to database</h2>";
}