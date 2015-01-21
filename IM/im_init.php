<?php
//require"testeasemob.php";
require"Easemob.class.php";

$client_id = "YXA6RuQo8H6sEeStiMnD1orqvQ";
$client_secret = "YXA6LmyUOP0uC1UB3OkEtpoyWTbS3VQ";
$org_name = "ecloudz";
$app_name = "elcoudz";

$easeMob = new Easemob([
    'client_id'=>$client_id,
    'client_secret'=>$client_secret,
    'org_name'=>$org_name,
    'app_name'=>$app_name
]);



