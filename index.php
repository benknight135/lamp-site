<?php
declare(strict_types=1);
require_once('vendor/autoload.php');

(new LampSite\NoCache())->generate_header();

// Create welcome message
echo "<h1>" . (new LampSite\Hello())->message() . "</h1>";

// Initalise database
$database = new LampSite\Database();

// Connect to database
if ($database->connect()) {
  echo "<h2>Database connected successfully</h2>";
} else {
  echo "<h2>Failed to connect to database</h2>";
}
