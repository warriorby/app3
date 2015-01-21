<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
if (isset($uid)) {
    $return_arr = $d2b->select("space_exper","*",["uid"=>$uid]);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
