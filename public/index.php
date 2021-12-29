<?php
    require_once('../vendor/autoload.php');

    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    if ($url === '/') {
        include_once '../templates/home.php';
    } else {
        http_response_code(404);
        include_once '../templates/404.php';
        die();
    }
?>