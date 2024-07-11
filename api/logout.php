<?php

require '../config.php';

session_start();

security::Bearer(Bearer::API);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $result = member::logout();

    echo json_encode($result);
}

?>