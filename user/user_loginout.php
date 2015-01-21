<?php
require("../include/connection.php");
require("../include/get_data.php");

$uid = $arr['uid'];
if (isset($uid)) {
    $d2b->update("user_main",["status"=>0],["uid"=>$uid]);
    $return_arr = array("uid" => $uid);

    include("../include/return_data.php");
} else {
    echo 0;
}
