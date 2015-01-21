<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$role = $arr['role'];
if (isset($uid) && isset($role)) {
    $sql = "select * from task_main a left join task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.role=1 and date(FROM_UNIXTIME(a.start_time)) = curdate() order by a.start_time desc";
    $rs = $d2b->query($sql);
    $rs_arr = $rs->fetchAll(PDO::FETCH_ASSOC);

    $sql2 = "select * from task_main a left join task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.role=2 and date(FROM_UNIXTIME(a.start_time)) = curdate() order by a.start_time desc";
    $rs2 = $d2b->query($sql2);
    $rs2_arr = $rs2->fetchAll(PDO::FETCH_ASSOC);
    $data_arr = array_merge($rs_arr,$rs2_arr);
    $return_arr = $data_arr;
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
