<?php
require("../include/conn.php");
require("../include/get_data.php");

$subject = $arr['subject'];
$uid = $arr['uid'];
if (isset($subject)) {
    $timestamp = time();
    $rs_arr = $d2b->select("score_profile",["sub_id"],["AND"=>["uid"=>$uid,"subject"=>$subject]]);
    if(count($rs_arr)==0){
        $sub_id = $d2b->insert("score_profile", ["uid"=>$uid,"subject" => $subject,"status" => 1, "updated" => $timestamp]);
    }else{
        $sub_id = $rs_arr[0]['sub_id'];
    }
    $return_arr = ["sub_id" => $sub_id,"uid"=>$uid,"subject" => $subject];
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
