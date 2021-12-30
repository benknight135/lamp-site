<?php
require_once('../../vendor/autoload.php');

$default_name = "guest";
$name = $default_name;
if (array_key_exists('name', $_POST)){
    $name = $_POST['name'];
    if ($name == null) {
        $name = $default_name;
    }
    $db = LampSite\Database::getInstance(); 
    if ($db->isConnected()){
        
    }
}
echo "$name";