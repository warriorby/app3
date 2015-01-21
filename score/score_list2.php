<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$sub_arr = array();
$sub3_arr = array();
if (isset($uid)) {
    $times = time();
    $m = date("m", $times);
    $Y = date("Y", $times);
    if ($m >= 3 && $m <= 8) {
        $start_m = $Y."-3-1";
        $end_m = $Y."-8-31";
        $sql = "SELECT * FROM score_main WHERE uid=$uid and DATE_FORMAT(exam_date,'%Y%m') BETWEEN DATE_FORMAT('$start_m','%Y%m') and DATE_FORMAT('$end_m','%Y%m') order by exam_date asc";
    } else {
        $start2_m = $Y."-9-1";
        $end2_m = ($Y+1)."-2-28";
        $sql = "SELECT * FROM score_main WHERE uid=$uid and DATE_FORMAT(exam_date,'%Y%m') BETWEEN DATE_FORMAT('$start2_m','%Y%m') and DATE_FORMAT('$end2_m','%Y%m') order by exam_date asc";
    }
    $rs = $d2b->query($sql);
    $rs_arr = $rs->fetchAll(PDO::FETCH_ASSOC);
    $i = count($rs_arr);
    if ($i > 0) {
        $user_total = 0;
        foreach ($rs_arr as $row) {
            $score = (int)$row['score'];
            $exam_date = $row['exam_date'];
            $average = (float)$row['average'];
            $updated = date("Y-m-d", $row['updated']);
            $user_total += $score;
            $sub_arr[] = ["uid" => $uid, "sub_id" => $sub_id, "score" => $score, "exam_date" => $exam_date, "average" => $average, "updated" => $updated];
        }
        $user_aver = $user_total / $i;
        foreach ($sub_arr as $row2) {
            $aver_arr = ["user_aver" => $user_aver];
            $sub3_arr[] = array_merge($row2, $aver_arr);
        }
    }
    $return_arr = $sub3_arr;
    include "../include/return_data.php";
} else {
    echo json_encode(0);
}
