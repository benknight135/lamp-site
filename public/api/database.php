<?php
require_once('../../vendor/autoload.php');

if (array_key_exists('name', $_POST)){
    $name = $_POST['name'];
    if ($name == null) {
        echo "NA";
        return;
    }
    $db = LampSite\Database::getInstance(); 
    if ($db->isConnected()){
        echo "$name";
        return;
    }
    echo "NA";
    return;
}
echo "NA";
return;