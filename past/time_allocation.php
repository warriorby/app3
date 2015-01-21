<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
if (isset($uid)) {
    $sql = "select * from task_main where uid=$uid and task_status=3 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";
    $sql2 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=1 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";
    $sql3 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=2 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";
    $sql4 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=3 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";
    $sql5 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=4 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";
    $sql6 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=5 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";
    $sql7 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=6 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";

    //total
    $rs = $d2b->query($sql);
    $rs_arr = $rs->fetchAll(PDO::FETCH_ASSOC);
    $week_count = 0;
    foreach ($rs_arr as $key => $value) {
        $week_count += $value['cost_time'];
    }

    //task_type=1
    $rs2 = $d2b->query($sql2);
    $rs2_arr = $rs2->fetchAll(PDO::FETCH_ASSOC);
    $study_count = 0;
    foreach ($rs2_arr as $key => $value) {
        $study_count += $value['cost_time'];
    }

    //task_type=2
    $rs3 = $d2b->query($sql3);
    $rs3_arr = $rs3->fetchAll(PDO::FETCH_ASSOC);
    $sports_count = 0;
    foreach ($rs3_arr as $key => $value) {
        $sports_count += $value['cost_time'];
    }

    //task_type=3
    $rs4 = $d2b->query($sql4);
    $rs4_arr = $rs4->fetchAll(PDO::FETCH_ASSOC);
    $play_count = 0;
    foreach ($rs4_arr as $key => $value) {
        $play_count += $value['cost_time'];
    }

    //task_type=4
    $rs5 = $d2b->query($sql5);
    $rs5_arr = $rs5->fetchAll(PDO::FETCH_ASSOC);
    $life_count = 0;
    foreach ($rs5_arr as $key => $value) {
        $life_count += $value['cost_time'];
    }

    //task_type=5
    $rs6 = $d2b->query($sql6);
    $rs6_arr = $rs6->fetchAll(PDO::FETCH_ASSOC);
    $talent_count = 0;
    foreach ($rs6_arr as $key => $value) {
        $talent_count += $value['cost_time'];
    }

    //task_type=6
    $rs7 = $d2b->query($sql7);
    $rs7_arr = $rs7->fetchAll(PDO::FETCH_ASSOC);
    $read_count = 0;
    foreach ($rs7_arr as $key => $value) {
        $read_count += $value['cost_time'];
    }
    $week_total = 48 * 60;
    $return_arr = ["uid" => $uid, "week_total" =>$week_total,"week_count" => $week_count,"study_count" => $study_count,"sports_count" => $sports_count,"play_count" => $play_count,
                "life_count" => $life_count,"talent_count" => $talent_count,"read_count" => $read_count];
    include "../include/return_data.php";
} else {
    echo json_encode(0);
}