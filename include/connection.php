<?php
$dsn = 'mysql:host=localhost;dbname=qingzi';
$user = 'qingzi';
$password = 'u9zNnmyeyY5uXYD8';
try{
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec('set names gbk');
   // echo "连接成功！";
}catch(Exception $e){
    die("-404");
}