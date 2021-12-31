<?php
    require_once('../vendor/autoload.php');
    
    $view = NULL;
    // start storing data in output buffer
    // to avoid rendering until it's knwon to be valid
    ob_start();

    try{
        
        // send no-cache header
        header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        
        // parse input url to get url path
        $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        
        // create view based on url
        $known_url = false;
        if ($url === '/') {
            // create 'home' page from template
            $view = new LampSite\ViewTemplate(
                "Home", __DIR__ . '/../templates/views/home.php');
            $known_url = true;
        }
        
        // show 'page not found' if no view was found for that url
        if (!$known_url){
            // create 'page not found' view from template
            $view = new LampSite\ViewTemplate(
                "Page not found", __DIR__ . '/../templates/views/404.php');
            error_log("Page not found:" . $url, 0);
        }
    
    } catch (Exception $e) {
        // show 'server error' page when exception is caught
        // create 'server error' page view from template
        error_log($e, 0);
        $view = new LampSite\ViewTemplate(
            "Server error", __DIR__ . '/../templates/views/500.php');
    }

    // view should never be null but to be safe show 'server error' if it is
    if (is_null($view)){
        error_log("template view is null", 0);
        $view = new LampSite\ViewTemplate(
            "Server error", __DIR__ . '/../templates/views/500.php');
    }

    try{
        // render page view from template
        $view->addDefaultStylesheets();
        $view->render();
    } catch (Exception $e) {
        // show 'server erorr' page if exception is caught during view render
        ob_end_clean();  // clean output buffer to remove already rendered views 
        error_log($e, 0);
        try{
            // create 'server error' page view from template
            $view = new LampSite\ViewTemplate(
                "Server error", __DIR__ . '/../templates/views/500.php');
            $view->addDefaultStylesheets();
            $view->render();
        } catch (Exception $e) {
            // if there is an issue rendering the 'server error' from template view
            // then must show server error in plain html so it is clear something has gone wrong.
            ob_end_clean();  // clean output buffer to remove already rendered views 
            error_log("Failed to render 'internal server error' page! As a fall back, will simply display 'Internal server error (500)'", 0);
            echo "Internal server error (500)";
        }
    }

    // send out contents of buffer (render page)
    ob_flush();
?>