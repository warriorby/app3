<?php
require "../include/conn.php";
require "../include/get_data.php";

$uid = $arr['uid'];
$sub_arr = array();
if (isset($uid)) {
    for ($d = 30; $d >= 1; $d--) {
        $sql = "select * from task_main where uid=$uid and task_status=3 and TO_DAYS(NOW())-TO_DAYS(FROM_UNIXTIME(end_time)) =$d";
        $rs = $d2b->query($sql);
        $rs_arr = $rs->fetchAll(PDO::FETCH_ASSOC);
        if (count($rs_arr) > 0) {
            $end_time = $rs_arr[0]['end_time'];
            $plan_time_total = 0;
            $real_time_total = 0;
            foreach ($rs_arr as $key => $value) {
                $plan_time_total += $value['plan_time'];
                $real_time_total += $value['cost_time'];
            }
            if ($plan_time_total != 0) {
                $grow_per = round($real_time_total / $plan_time_total, 2) * 100;
            } else {
                $grow_per = 0;
            }
            $dateTime = date("Y-m-d", $end_time);
            $sub_arr[] = ["uid" => $uid, "grow_per" => $grow_per, "date" => $dateTime];
        }
    }
    $return_arr = $sub_arr;
    include "../include/return_data.php";
} else {
    echo json_encode(0);
}
