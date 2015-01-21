<?php
require "medoo.php";

try{
    $d2b = new medoo([
        'database_type' => 'mysql',
        'database_name' => 'demo2',
        'server' => 'localhost',
        'username' => 'root',
        'password' => '123456',

        'port' => 3306,
        'charset' => 'utf8',
        "option"=>[
            PDO::ATTR_CASE => PDO::CASE_NATURAL,
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
        ]
    ]);
    // echo "连接成功！";
}catch(Exception $e){
    die("-404");
}