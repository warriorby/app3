<?php
require("../include/conn.php");
require("../include/get_data.php");

$zid = $arr['zid'];
$sid = sprintf("%03d",$arr['sid']);
if (isset($zid) && isset($sid)) {
    $return_arr = $d2b->select("clazz_list", "*", ["AND" => ["zid" => $zid, "sid" => $sid]]);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}