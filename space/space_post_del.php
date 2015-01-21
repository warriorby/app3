<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$pid = $arr['pid'];
if (isset($uid) && isset($pid)) {
    $d2b->delete("space_post",["AND"=>["uid"=>$uid,"pid"=>$pid]]);
    $post_url = $post_upload . $post;
    $post_del = unlink($post_url);

    if ($post_del == true) {
        $return_arr = array("uid" => $uid);
        include("../include/return_data.php");
    }else
        echo json_encode(0);
} else {
    echo json_encode(0);
}