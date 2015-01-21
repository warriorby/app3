<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$eid = $arr['eid'];

if (isset($uid) && isset($eid)) {
    $d2b->delete("space_exper",["AND"=>["uid"=>$uid,"eid"=>$eid]]);
    $return_arr = array("uid" => $uid);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
