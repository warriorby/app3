<?php
require "../include/conn.php";
require "../include/get_data.php";

$uid = $arr['uid'];
if (isset($uid)) {
    $rs_arr = $d2b->select("user_main",["integral"],["uid"=>$uid]);
    $gold = $rs_arr[0]['integral'];
    $return_arr = ['uid' => $uid, 'integral' => $gold];
    include "../include/return_data.php";
} else {
    echo json_encode(0);
}