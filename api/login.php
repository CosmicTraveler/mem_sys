<?php

require '../config.php';

session_start();

security::Bearer(Bearer::API);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);

    $payload = [
        'username'    => $data['username'],
        'password'    => $data['password'],
    ];

    $result = member::login($payload);
    
    if($result['status'] === 'fail') {
        echo json_encode($result);
        exit();
    }

    echo json_encode($result);
}

?>