<?php
require_once(__DIR__ . '/../../vendor/autoload.php');

function post_login(){
    $required_data_arr = array("username","password");
    $input_data_arr;
    foreach ($required_data_arr as $required_data){
        if (!array_key_exists($required_data, $_POST)){
            $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
            $response['body'] = json_encode([
                'error' => 'Invalid input'
            ]);
            return $response;
        }
        $data_value = $_POST[$required_data];
        if ($data_value == null) {
            $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
            $response['body'] = json_encode([
                'error' => 'Invalid input'
            ]);
            return $response;
        }
        $input_data_arr[$required_data] = $data_value;
    }
    $username = $input_data_arr["username"];
    $password = $input_data_arr["password"];
    $db = LampSite\Database::getInstance();
    if (!$db->isConnected()){
        $response['status_code_header'] = 'HTTP/1.1 500 Internal Server Error';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }
    if (!$db->addUser($username, $password)){
        $response['status_code_header'] = 'HTTP/1.1 500 Internal Server Error';
        $response['body'] = json_encode([
            'error' => 'Failed to add user'
        ]);
        return $response;
    }
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $response['body'] = json_encode($new_count);
    return $response;
}

$response['status_code_header'] = 'HTTP/1.1 404 Not Found';
if ($request_method == 'POST'){
    $response = post_login();
}

header($response['status_code_header']);
if (array_key_exists('body', $response)) {
    echo $response['body'];
}