<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$role = $arr['role'];
if (isset($uid) && isset($role)) {
    $rs = $d2b->query("SELECT * FROM task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=1 and a.role=1");
    $rs_arr = $rs->fetchAll(PDO::FETCH_ASSOC);

    $rs3 = $d2b->query("SELECT * FROM task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=1 and a.role=2");
    $rs3_arr = $rs3->fetchAll(PDO::FETCH_ASSOC);
    $return_arr = array_merge($rs3_arr, $rs_arr);
    include "../include/return_data.php";
} else {
    echo json_encode(0);
}
	
