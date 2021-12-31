<?php
    require_once(__DIR__ . '/../vendor/autoload.php');

    // start storing data in output buffer
    // to avoid rendering until it's knwon to be valid
    ob_start();

    function render_view_header(){
        // no-cache header
        header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
    }

    function render_api_header(){
        // no-cache header
        header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        // api header
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    function render_internal_server_error(){
        // show 'server erorr' page if exception is caught during view render
        ob_end_clean();  // clean output buffer to remove already rendered views 
        error_log($e, 0);
        try{
            render_view_header();
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

    function render_view_template($title, $template_file){
        try {
            render_view_header();
            // create 'home' page from template
            $view = new LampSite\ViewTemplate($title, $template_file);
            // render page view from template
            $view->addDefaultStylesheets();
            $view->render();
        } catch (Exception $e) {
            render_internal_server_error();
        }
    }

    try{
        // parse input url to get url path
        $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $uri = explode( '/', $url );
        
        // create view based on url
        $known_url = false;
        if ($url === '/') {
            $known_url = true;
            render_view_template(
                "Home", __DIR__ . '/../templates/views/home.php');    
        }
        if ($url === '/api/count'){
            $request_method = $_SERVER["REQUEST_METHOD"];
            if ($request_method == 'GET' || $request_method == 'POST'){
                $known_url = true;
                // process data for api database call
                try {
                    render_api_header();
                    $template_file = __DIR__ . '/../templates/api/count.php';
                    if (!is_readable($template_file)) {
                        throw new \Exception("Failed to find template api file");
                    }
                    require($template_file);
                } catch (Exception $e) {
                    render_internal_server_error();
                }
            }
        }
        
        // show 'page not found' if no view was found for that url
        if (!$known_url){
            // create 'page not found' view from template
            render_view_template(
                "Page not found", __DIR__ . '/../templates/views/404.php');
            error_log("Page not found:" . $url, 0);
        }
    
    } catch (Exception $e) {
        // show 'server error' page when exception is caught
        // create 'server error' page view from template
        error_log($e, 0);
        render_internal_server_error();
    }

    // send out contents of buffer (render page)
    ob_flush();
?>