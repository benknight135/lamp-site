<?php
require_once(__DIR__ . '/../../vendor/autoload.php');

function post_increment_count(){
    if (!array_key_exists('user', $_POST)){
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }
    $user = $_POST['user'];
    if ($user == null) {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }
    $db = LampSite\Database::getInstance();
    if (!$db->isConnected()){
        $response['status_code_header'] = 'HTTP/1.1 500 Internal Server Error';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }
    if (!$db->incrementCount($user)){
        $response['status_code_header'] = 'HTTP/1.1 500 Internal Server Error';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }
    $new_count = $db->getCount($user);
    if ($new_count < 0){
        $response['status_code_header'] = 'HTTP/1.1 500 Internal Server Error';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $response['body'] = json_encode($new_count);
    return $response;
}

function get_count(){
    if (!array_key_exists('user', $_GET)){
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }
    $user = $_GET['user'];
    if ($user == null) {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }
    $db = LampSite\Database::getInstance();
    if (!$db->isConnected()){
        $response['status_code_header'] = 'HTTP/1.1 500 Internal Server Error';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }
    $new_count = $db->getCount($user);
    if ($new_count < 0){
        $response['status_code_header'] = 'HTTP/1.1 500 Internal Server Error';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $response['body'] = json_encode($new_count);
    return $response;
}

$response['status_code_header'] = 'HTTP/1.1 404 Not Found';

if ($request_method == 'GET'){
    $response = get_count();
}
if ($request_method == 'POST'){
    $response = post_increment_count();
}

header($response['status_code_header']);
if ($response['body']) {
    echo $response['body'];
}