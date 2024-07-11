<?php

class security
{
    public static function InitCookie(): void
    {
        // Setting a secure cookie
        setcookie("session_id", session_id(), [
            'expires'   => time() + 3600,
            'path'      => '/',
            'domain'    => DOMAIN_SITE,
            'secure'    => true,
            'httponly'  => true,
            'samesite'  => 'Strict',
        ]);
    }

    public static function InitSecurity(): void
    {
        $_SESSION['bearer'] = self::getSecurityToken();

        if (!isset($_COOKIE['session_id']))
            self::InitCookie();
    }

    public static function Bearer($type): void
    {
        if(!isset($_SESSION['bearer']) || !$_SESSION['bearer']) {
            echo json_encode(util::ReturnResponse('No Authorization','fail'));
            exit();
        }
        
        if(!self::verifySecurityToken($_SESSION['bearer'])) {
            
            if($type === Bearer::API)
                echo json_encode(util::ReturnResponse('Invalid security token','fail'));

            if($type === Bearer::LOGIN)
                echo json_encode(util::ReturnResponse('No Authorization','fail'));
        
            exit();
        }
    }

    public static function verifySecurityToken($token): bool
    {
        $decrpyt_value = encrypt::decrypt($token);

        if($decrpyt_value !== ENCRYPT_KEY)
            return false;

        return true;
    }

    public static function getSecurityToken(): string
    {
        return encrypt::encrypt(ENCRYPT_KEY);
    }    
}

?>