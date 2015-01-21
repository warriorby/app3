<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$role = $arr['role'];

if(isset($uid) && isset($role)){
    $rs_arr = $d2b->select("user_main",["balance"],["uid"=>$uid],["role"=>$role]);
    $balance = $rs_arr[0]['balance'];

    $return_arr = array("uid"=>$uid, "role"=>$role, "balance"=>$balance);
    include("../include/return_data.php");
}else{
    echo json_encode(0);
}