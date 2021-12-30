<?php
require_once('../../vendor/autoload.php');

if (array_key_exists('name', $_POST)){
    $name = $_POST['name'];
    if ($name == null) {
        echo "NA";
        die();
    }
    $db = LampSite\Database::getInstance(); 
    if ($db->isConnected()){
        if ($db->incrementCount($name)){
            echo strval($db->getCount($name));
            die();
        }
        echo "NA";
        die();
    }
    echo "NA";
    die();
}
echo "NA";
die();