<?php

class query {
    private static $database;
    private static function connect() {
        self::$database = new medoo([
            'database_type' => 'mysql',
            'database_name' => DB_NAME,
            'server'        => DB_SERVER,
            'username'      => DB_USERNAME,
            'password'      => DB_PASSWORD,
            'port'          => DB_PORT,
            'charset'       => DB_CHARSET,
        ]);
    }
    
    public static function Insert($table_name, $data, $key = null): int
    {
        self::connect();

        if(isset($key) && !empty($key)){

            $where = [
                $key => $data[$key],
            ];

            $res = [];
            $res = self::Get($table_name, $where);

            if(!empty($res))
                return -1;
        }

        self::$database->insert($table_name, $data);
        return self::$database->id();
    }
    
    public static function Update($table_name, $data, $where = []): bool
    {
        self::connect();
        $count = 0;

        $count = self::$database->count($table_name, $where);

        if ($count > 0) {
            self::$database->update($table_name, $data, $where);
            return true;
        }

        return false;
    }
    
    public static function Select($table_name, $where = []): array
    {
        self::connect();
        $count = 0;

        $count = self::$database->count($table_name, $where);

        if ($count > 0) {
            return self::$database->select($table_name, "*", $where);
        }

        return [];
    }
    
    public static function Get($table_name, $where = []): array
    {
        self::connect();
        $count = 0;

        $count = self::$database->count($table_name, $where);

        if ($count) {
            return self::$database->get($table_name, "*", $where);
        }

        return [];
    }
    
    public static function Delete($table_name, $where = []): bool
    {
        self::connect();
        $count = 0;

        $count = self::$database->count($table_name, $where);

        if ($count > 0) {
            self::$database->delete($table_name, $where);
            return true;
        }

        return false;
    }
    
    public static function Sum($table_name, $column, $where = []): int
    {
        self::connect();
        $count = 0;

        $count = self::$database->count($table_name, $where);

        if ($count > 0) {
            return self::$database->sum($table_name, $column, $where);
        }

        return 0;
    }
    
    public static function SelectOnly($table_name, $column, $where = []): array
    {
        self::connect();
        $count = 0;

        $count = self::$database->count($table_name, $where);

        if ($count > 0) {
            return self::$database->select($table_name, $column, $where);
        }
        return [];
    }
}

?>