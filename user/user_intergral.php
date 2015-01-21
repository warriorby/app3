<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr["uid"];
$role = $arr["role"];
if(isset($uid) && isset($role)){
    $rs_arr = $d2b->select("user_main",["integral"],["AND"=>["uid"=>$uid,"role"=>$role]]);
    $integral = $rs_arr[0]['integral'];
    $return_arr = ["integral"=>(int)$integral];
    include "../include/return_data.php";
}else{
    echo json_encode(0);
}