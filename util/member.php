<?php

class member {

    private static function sanitize_register($data): array
    {
        $data['username'] = htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8');
        $data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        return $data;
    }

    public static function register($data): array
    {
        $data = self::sanitize_register($data);

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return util::ReturnResponse('อีเมลไม่ถูกต้อง');
        }

        if (!util::regexUserName($data['username'])) {
            return util::ReturnResponse('username ไม่ถูกต้อง');
        }

        if (!util::regexPassword($data['password'])) {
            return util::ReturnResponse('รูปแบบรหัสผ่านไม่ถูกต้อง');
        }

        if (strlen($data['username']) < MINIMUN_PASSWORD_LENGTH || strlen($data['username']) > MAXIMUN_PASSWORD_LENGTH) {
            return util::ReturnResponse('ชื่อผู้ใช้ต้องมีความยาวระหว่าง '.MINIMUN_PASSWORD_LENGTH.' ถึง '.MAXIMUN_PASSWORD_LENGTH.' ตัวอักษร');
        }

        if (strlen($data['password']) < MINIMUN_PASSWORD_LENGTH) {
            return util::ReturnResponse('รหัสผ่านต้องมีความยาวอย่างน้อย '.MINIMUN_PASSWORD_LENGTH.' ตัวอักษร');
        }

        if(ENABLE_HASH_PASSWORD)
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $payload = [
            'userid'      => $data['username'],
            'user_pass'   => $data['password'],
            'email'       => $data['email'],
            'birthdate'   => $data['dateofbirth'],
            'status'      => 0,
        ];

        $where = [
            "userid" => $payload['userid']
        ];

        $existingUser = query::Get(TABLE_USER, $where);

        if ($existingUser) {
            return util::ReturnResponse('ชื่อผู้ใช้หรืออีเมลนี้มีอยู่แล้ว');
        }

        $result = query::Insert(TABLE_USER, $payload);
        return util::ReturnResponse('สมัครสมาชิกเรียบร้อย', 'success', ['id' =>  $result]);
    }

    public static function login($data): array
    {
        if (!util::regexUserName($data['username'])) {
            return util::ReturnResponse('username ไม่ถูกต้อง');
        }

        if (!util::regexPassword($data['password'])) {
            return util::ReturnResponse('รูปแบบรหัสผ่านไม่ถูกต้อง');
        }

        $payload = [
            'userid'      => $data['username'],
            'user_pass'   => $data['password'],
        ];

        $user = query::Get(TABLE_USER, ["userid" => $payload['userid']]);

        if(ENABLE_HASH_PASSWORD){
            if (!$user || !password_verify($data['user_pass'], $user['user_pass'])) {
                return util::ReturnResponse('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
            }
        }else if(empty($user))
            return util::ReturnResponse('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');

        self::setLoggedInUser($user);

        return util::ReturnResponse('เข้าสู่ระบบสําเร็จ', 'success');
    }

    public static function logout(): array
    {
        unset($_SESSION['account_id']);
        unset($_SESSION['userid']);
        unset($_SESSION['bearer']);
        unset($_SESSION['isLoggedIn']);
        unset($_SESSION['is_admin']);
        setcookie('session_id', '', time() - 3600, '/');
        session_destroy();
        return util::ReturnResponse('ออกจากระบบสําเร็จ', 'success');
    }

    public static function setLoggedInUser($user): void
    {
        $_SESSION['account_id'] = $user['account_id'];
        $_SESSION['userid']     = $user['userid'];
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['is_admin']   = $user['group_id'] == 99 ? true : false;
    }

    public static function checkLoggedInUser(): void
    {
        if(!isset($_SESSION['isLoggedIn']) && !$_SESSION['isLoggedIn']) {
            header('Location: index.php?code=login');
            exit;
        }
    }

    public static function alreadyLoggedIn(): void
    {
        if(!isset($_SESSION['isLoggedIn']))
            return;

        header('Location: home.php');
    }    
}

?>