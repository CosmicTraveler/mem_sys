<?php

require '../config.php';

session_start();

security::Bearer(Bearer::API);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);

    $AID = $_SESSION['account_id'];

    $user = query::Get(TABLE_USER , ['account_id' => $AID]);

    if(!$user) {
        echo json_encode(util::ReturnResponse('ข้อมูลผู้ใช้งานไม่ถูกต้อง'));
        exit();
    }

    if($data['new_password'] !== $data['confirm_password']) {
        echo json_encode(util::ReturnResponse('รหัสผ่านไม่ถูกต้อง'));
        exit();
    }

    if($data['current_password'] !== $user['user_pass']) {
        echo json_encode(util::ReturnResponse('รหัสผ่านปัจจุบันไม่ถูกต้อง'));
        exit();
    }

    if($data['new_password'] === $data['current_password']) {
        echo json_encode(util::ReturnResponse('รหัสผ่านใหม่ต้องไม่เหมือนกับรหัสผ่านปัจจุบัน'));
        exit();
    }

    if(strlen($data['new_password']) < MINIMUN_PASSWORD_LENGTH || strlen($data['new_password']) > MAXIMUN_PASSWORD_LENGTH) {
        echo json_encode(util::ReturnResponse('รหัสผ่านต้องมีความยาวตั้งแต่ '.MINIMUN_PASSWORD_LENGTH.' ตัวขึ้นไป'));
        exit();
    }

    if (!util::regexPassword($data['new_password'])) {
        echo json_encode(util::ReturnResponse('รูปแบบรหัสผ่านไม่ถูกต้อง'));
        exit();
    }

    $new_password = $data['new_password'];

    query::Update(TABLE_USER , ['user_pass' => $new_password] , ['account_id' => $AID]);
    echo json_encode(util::ReturnResponse('เปลี่ยนรหัสผ่านสําเร็จ','success'));
}

?>