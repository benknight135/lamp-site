<?php

if (!file_exists(__DIR__ . '/.env')) {
    die("You need to create a .env file!\n");
}

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');
$dotenv->load();