<?php

require '../config.php';

session_start();

security::Bearer(Bearer::API);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);

    $payload = [
        'username'    => $data['username'],
        'password'    => $data['password'],
        'email'       => $data['email'],
        'dateofbirth' => $data['dateofbirth'],
        'create_data' => date('Y-m-d H:i:s'),
    ];

    $result = member::register($payload);
    if($result['status'] === 'fail') {
        echo json_encode($result);
        exit();
    }

    echo json_encode($result);
}

?>