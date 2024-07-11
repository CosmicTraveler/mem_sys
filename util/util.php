<?php

class util
{

    public static function array_merge($main, $sub, $new_key, $mf_key, $sf_key): array
    {
        foreach ($main as $m_key => $m_data) {
            foreach ($sub as $s_data) {
                if ($m_data[$mf_key] == $s_data[$sf_key]) {
                    $main[$m_key][$new_key] = $s_data;
                }
            }
        }
        return $main;
    }

    public static function sort_array_by_key($array, $key, $sort_ascending = true): array
    {
        $temp_array[key($array)] = array_shift($array);
        foreach ($array as $val) {
            $offset = 0;
            $found = false;
            foreach ($temp_array as $tmp_val) {
                if (!$found and strtolower($val[$key]) > strtolower($tmp_val[$key])) {
                    $temp_array = array_merge(
                        (array)array_slice($temp_array, 0, $offset),
                        array($val),
                        array_slice($temp_array, $offset)
                    );
                    $found = true;
                }
                $offset++;
            }
            if (!$found) $temp_array = array_merge($temp_array, array($val));
        }
        if ($sort_ascending) $array = array_reverse($temp_array);
        else $array = $temp_array;
        return $array;
    }

    public static function getUserid($AID): string
    {
        $result = query::Get('login', ['account_id' => $AID]);
        return $result['userid'];
    }

    public static function ReturnResponse($message, $status = 'fail', $data = []): array
    {
        return ['status' => $status, 'message' => $message, 'data' => $data];
    }

    public static function regexUserName($input): bool
    {
        $pattern = '/^[a-zA-Z][a-zA-Z0-9_.-]{2,19}$/';
        
        if(!preg_match($pattern, $input))
            return false;

        return true;
    }

    public static function regexPassword($input): bool
    {
        $pattern = '/[^\w#@_]/';
        
        if(preg_match($pattern, $input))
            return false;

        return true;
    }

    public static function clearSelectChar(): void
    {
        unset($_SESSION['char_id']);
    }

    public static function GenerateCSRF(): string
    {
        return bin2hex(random_bytes(32));
    }
}
