<?php
require("../include/conn.php");
require("../include/get_data.php");

$cid = $arr['cid'];
$zid = $arr["zid"];
$school = $arr['school'];
$school_type = $arr['school_type'];
if (isset($cid) && isset($zid) && isset($school) && isset($school_type)) {
    $data = $d2b->select("school_list", "*", ["AND" => ["zid" => $zid, "school" => $school, "school_type" => $school_type]]);
    if (count($data) == 0) {
        $rs_arr = $d2b->select("school_list", ["sid"], ["zid" => $zid]);
        $data = end($rs_arr);
        $sid =  $data['sid']+1;
        $sid2 = sprintf("%03d", $sid);
        $insert_id = $d2b->insert("school_list", ["sid" => $sid2, "cid" => $cid, "zid" => $zid, "school" => $school, "school_type" => $school_type]);
        $return_arr = ["id" => $insert_id, "sid" => $sid2];
        include("../include/return_data.php");
    } else {
        echo json_encode(-105);
    }
} else {
    echo json_encode(0);
}