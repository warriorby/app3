<?php
require("../include/conn.php");
require("../include/get_data.php");

$zid = $arr['zid'];
$school_type = $arr['school_type'];
if (isset($zid) && isset($school_type)) {
    $return_arr = $d2b->select("school_list",["sid","school"],["AND"=>["zid"=>$zid,"school_type"=>$school_type]]);
    include("../include/return_data.php");
}else{
    echo json_encode(0);
}