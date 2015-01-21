<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$start = $arr['start'];
$end = $arr['end'];
$sub_id = $arr['sub_id'];
$return_arr =array();
if (isset($uid) && isset($sub_id)) {
    $sql = "select * from score_main where exam_date>='$start' and '$end'>=exam_date and uid=$uid and sub_id=$sub_id order by exam_date asc";
    $rs = $d2b->query($sql);
    $rs_arr = $rs->fetchAll(PDO::FETCH_ASSOC);
    foreach($rs_arr as $row){
        $score_id = $row['score_id'];
        $uid = $row['uid'];
        $sub_id = $row['sub_id'];
        $score = (int)$row['score'];
        $total = $row['total'];
        $average = (float)$row['average'];
        $exam_date = $row['exam_date'];
        $return_arr[]=["score_id"=>$score_id,"uid"=>$uid,"sub_id"=>$sub_id,"score"=>$score,"total"=>$total,"average"=>$average,"exam_date"=>$exam_date];
    }
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}