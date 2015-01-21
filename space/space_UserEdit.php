<?php
require "../include/conn.php";
require "../include/get_data.php";

$uid = $arr['uid'];
$real_name = $arr['real_name'];
$sex = $arr['sex'];
$birth = $arr['birth'];
if(isset($uid) && isset($real_name) && isset($sex) && isset($birth)){
    $d2b->update("user_profile",["real_name"=>$real_name,"sex"=>$sex,"birth"=>$birth],["uid"=>$uid]);
    $return_arr = ['uid'=>$uid,'real_name'=>$real_name,'sex'=>$sex,'birth'=>$birth];
    include "../include/return_data.php";
}else{
    echo json_encode(0);
}