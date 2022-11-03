<?php
namespace App\Config;

class Database {
    public static function db(){
        return [
            "default" => [
                "server" => "localhost",
                "user" => "root",
                "pass" => "",
                "dbname" => "your_db",
                "driver" => "mysql"
            ],
            "ms" => [
                "server" => "sql server",
                "user" => "root",
                "pass" => "",
                "dbname" => "your_db",
                "driver" => "mssql"
            ],
        ];
    }
}
