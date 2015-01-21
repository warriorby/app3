<?php
require "../include/conn.php";
require "../include/get_data.php";

$uid = $arr['uid'];
$sub_arr = array();
if (isset($uid)) {
    for ($d = 7; $d >= 1; $d--) {
        $sql2 = "select * from task_main where uid=$uid and task_status=3 and TO_DAYS(NOW())-TO_DAYS(FROM_UNIXTIME(end_time)) =$d";
        $rs2 = $d2b->query($sql2);
        $rs2_arr = $rs2->fetchAll(PDO::FETCH_ASSOC);
        if (count($rs2_arr) == 0) {
            $sub_arr[] = ["uid" => $uid, "week_day" => 8];
        } else {
            foreach ($rs2_arr as $row) {
                $end_time = $row['end_time'];
                $sql = "select * from task_main where uid=$uid and task_status=3 and date(FROM_UNIXTIME(end_time))=date(FROM_UNIXTIME($end_time))";
                $rs = $d2b->query($sql);
                $rs_arr = $rs->fetchAll(PDO::FETCH_ASSOC);
                $plan_time_total = 0;
                $real_time_total = 0;
                $i = 0;
                foreach ($rs_arr as $key => $value) {
                    $plan_time_total += $value['plan_time'];
                    $real_time_total += $value['cost_time'];
                    $i++;
                }
                $week_day = date("w", $end_time);
            }
            $sub_arr[] = ["uid" => $uid, "task_count" => $i, "plan_time_total" => $plan_time_total, "cost_time_total" => $real_time_total, "week_day" => $week_day];
        }
    }
    $return_arr = $sub_arr;
    include "../include/return_data.php";
} else {
    echo json_encode(0);
}