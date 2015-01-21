<?php
require "../include/conn.php";
require"../include/get_data.php";

$uid = $arr['uid'];
$pid = $arr['pid'];
$cid = $arr['cid'];
$zid = $arr['zid'];
$sid = $arr['sid'];
$gid = $arr['gid'];
$class_id = $arr['class_id'];

if(isset($uid) && isset($pid) && isset($cid) && isset($zid) && isset($sid) && isset($gid) && isset($class_id)){
    $data_arr = ["pid"=>$pid,"cid"=>$cid,"zid"=>$zid,"sid"=>$sid,"gid"=>$gid,"class_id"=>$class_id];
    $dab->update("user_education",$data_arr,["uid"=>$uid]);

    $return_arr = array_merge($data_arr,$where_arr);
    include "../include/return_data.php";
}else{
    echo json_encode(0);
}