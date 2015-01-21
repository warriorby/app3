<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$post_name = $arr['post'];
if(isset($uid) && isset($post_name)){
    $timestamp = time();
    $pid = $d2b->insert("space_post",["uid"=>$uid,"post"=>$post_name,"updated"=>$timestamp]);

    $return_arr = ['uid'=>$uid,"post"=>$post_name,"pid"=>$pid];
    include "../include/return_data.php";
}else{
    echo json_encode(0);
}
