<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$role = $arr['role'];
if (isset($uid) && isset($role)) {
    $sql = "select * from task_main a left join task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and task_status=3 and date(FROM_UNIXTIME(a.start_time)) = curdate() order by a.start_time DESC";
    $rs = $d2b->query($sql);
    $return_arr = $rs->fetchAll(PDO::FETCH_ASSOC);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
