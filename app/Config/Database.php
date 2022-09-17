<?php
namespace App\Config;

class Database {
    public static function db(){
        return [
            "default" => array(
                "server" => "localhost",
                "user" => "root",
                "pass" => "",
                "dbname" => "pms_db",
                "driver" => "mysql"
            )
        ];
    }
}
