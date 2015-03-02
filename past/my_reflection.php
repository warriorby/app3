<?php
require "../include/conn.php";
require "../include/get_data.php";

$uid = $arr['uid'];
if (isset($uid)) {
    $sql2 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=1";
    $sql3 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=2 ";
    $sql4 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=3 ";
    $sql5 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=4 ";
    $sql6 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=5 ";
    $sql7 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=6 ";

    //task_type=1
    $rs2 = $d2b->query($sql2);
    $rs2_arr = $rs2->fetchAll(PDO::FETCH_ASSOC);
    $study_total = 0;
    foreach ($rs2_arr as $key => $value) {
        $study_total += $value['cost_time'];
    }

    //task_type=2
    $rs3 = $d2b->query($sql3);
    $rs3_arr = $rs3->fetchAll(PDO::FETCH_ASSOC);
    $sports_total = 0;
    foreach ($rs3_arr as $key => $value) {
        $sports_total += $value['cost_time'];
    }

    //task_type=3
    $rs4 = $d2b->query($sql4);
    $rs4_arr = $rs4->fetchAll(PDO::FETCH_ASSOC);
    $play_total = 0;
    foreach ($rs4_arr as $key => $value) {
        $play_total += $value['cost_time'];
    }

    //task_type=4
    $rs5 = $d2b->query($sql5);
    $rs5_arr = $rs5->fetchAll(PDO::FETCH_ASSOC);
    $life_total = 0;
    foreach ($rs5_arr as $key => $value) {
        $life_total += $value['cost_time'];
    }

    //task_type=5
    $rs6 = $d2b->query($sql6);
    $rs6_arr = $rs6->fetchAll(PDO::FETCH_ASSOC);
    $talent_total = 0;
    foreach ($rs6_arr as $key => $value) {
        $talent_total += $value['cost_time'];
    }

    //task_type=6
    $rs7 = $d2b->query($sql7);
    $rs7_arr = $rs7->fetchAll(PDO::FETCH_ASSOC);
    $read_total = 0;
    foreach ($rs7_arr as $key => $value) {
        $read_total += $value['cost_time'];
    }
    $rs_arr = $d2b->select("user_main",["integral"],["uid"=>$uid]);
    $gold = $rs_arr[0]['integral'];
    $return_arr = ['uid' => $uid, 'integral' => $gold,"study_total" => $study_total,"sports_total" => $sports_total,"play_total" => $play_total,
        "life_total" => $life_total,"talent_total" => $talent_total,"read_total" => $read_total];
    include "../include/return_data.php";
} else {
    echo json_encode(0);
}