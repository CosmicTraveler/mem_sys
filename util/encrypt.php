<?php

class encrypt {

    public static function encrypt($value): string
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($value, 'aes-256-cbc', ENCRYPT_SALT, 0, $iv);
        return base64_encode($iv . $encrypted);        
    }

    public static function decrypt($value): string
    {
        $decoded = base64_decode($value);
        $iv = substr($decoded, 0, openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = substr($decoded, openssl_cipher_iv_length('aes-256-cbc'));
        return openssl_decrypt($encrypted, 'aes-256-cbc', ENCRYPT_SALT, 0, $iv);
    }

    public static function verify($value): bool
    {
        return self::decrypt($value) === $value ? true : false;
    }
}

?>