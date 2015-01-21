<?php
require("../include/conn.php");
require("../include/get_data.php");

$zid = $arr['zid'];
$sid = $arr['sid'];
$gid = $arr['gid'];
$cname = $arr['cname'];
if (isset($zid) && isset($sid) && isset($gid) && isset($cname)) {
    $sid2 = sprintf("%03d", $sid);
    $gid2 = sprintf("%02d", $gid);
    $rs_arr = $d2b->select("clazz_list", "*", ["AND" => ["zid" => $zid, "sid" => $sid2, "gid" => $gid2,"cname"=>$cname]]);
    if (count($rs_arr) == 0) {
        $classid = $d2b->insert("clazz_list", ["cname" => $cname,"zid" => $zid, "sid" => $sid2, "gid" => $gid2]);
        $return_arr = ["class_id" => $classid];
        include("../include/return_data.php");
    } else {
        echo json_encode(-104);
    }
} else {
    echo json_encode(0);
}