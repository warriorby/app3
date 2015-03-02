<?php
require("../include/conn.php");
require("../include/get_data.php");

$phone = $arr['phone'];
$pwd = $arr['password'];
$role = $arr['role'];
if(isset($phone) && isset($pwd) && isset($role)){
    $pwd = hash('sha256', $pwd);
    $d2b->update("user_main",["password"=>$pwd],["AND"=>["phone"=>$phone,"role"=>$role]]);
    $return_arr = ["phone"=>$phone,"password"=>$pwd];
    include("../include/return_data.php");
}else{
    echo json_encode(0);
}