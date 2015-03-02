<?php
require __DIR__."/../include/medoo.php";

try{
    $d3b = new medoo([
        'database_type' => 'mysql',
        'database_name' => 'weshare100.com',
        'server' => 'localhost',
        'username' => 'qingzi',
        'password' => 'u9zNnmyeyY5uXYD8',
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