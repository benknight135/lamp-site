<?php
    require_once('../vendor/autoload.php');
    
    header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', FALSE);
    header('Pragma: no-cache');

    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    $view = new LampSite\ViewTemplate(
        "Page not found", __DIR__ . '/../templates/views/404.php');
    if ($url === '/') {
        $view = new LampSite\ViewTemplate(
            "Home", __DIR__ . '/../templates/views/home.php');
    }
    $view->addDefaultStylesheets();

    $view->render();
?>