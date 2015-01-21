<?php
$dsn = 'mysql:host=localhost;dbname=demo2';
$user = 'root';
$password = '123456';
try{
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec('set names gbk');
   // echo "连接成功！";
}catch(Exception $e){
    die("-404");
}