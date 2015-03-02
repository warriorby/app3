<?php
require_once("../include/conn.php");
require_once("../include/get_data.php");

$uid_p = $arr['uid_p'];
$code_key = $arr['code_key'];
$rs_arr = $d2b->select("key_list","*",["code_key"=>$code_key]);
if(count($rs_arr) ==0){
    echo json_encode(0);
}else{
    $d2b->update("key_list",["uid_p"=>$uid_p],["code_key"=>$code_key]);
    $uid_c = $rs_arr[0]['uid_c'];
    $return_arr = ["uid_c"=>$uid_c];
    require_once '../include/return_data.php';
}



