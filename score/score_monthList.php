<?php
require("../include/conn.php");
require("../include/get_data.php");

$uid = $arr['uid'];
$sub_id = $arr['sub_id'];
$dateTime = $arr['dateTime'];
$sub_arr = array();
$sub3_arr=array();
if(isset($uid) && isset($sub_id) && isset($dateTime)){
    $dateTime2 = $dateTime."-1";
    $sql="SELECT * FROM score_main WHERE uid=$uid and sub_id=$sub_id and DATE_FORMAT(exam_date, '%Y%m')=DATE_FORMAT('$dateTime2','%Y%m') order by exam_date asc";
    $rs = $d2b->query($sql);
    $rs_arr = $rs->fetchAll(PDO::FETCH_ASSOC);
    $i =count($rs_arr);
    if($i>0){
        $user_total=0;
        foreach($rs_arr as $row){
            $score_id = $row['score_id'];
            $score = (int)$row['score'];
            $total = (int)$row['total'];
            $exam_date = $row['exam_date'];
            $average = (float)$row['average'];
            $updated = date("Y-m-d",$row['updated']);
            $user_total+=$score;
            $sub_arr[] = ["uid" => $uid,"score_id"=>$score_id, "sub_id" => $sub_id,"score"=>$score,"total"=>$total,
                "exam_date"=>$exam_date,"average"=>$average,"updated"=>$updated];
        }
        $user_aver = $user_total/$i;
        foreach($sub_arr as $row2){
            $aver_arr = ["user_aver"=>$user_aver];
            $sub3_arr[] = array_merge($row2,$aver_arr);
        }
    }
    $return_arr = $sub3_arr;
    include "../include/return_data.php";
}else{
    echo json_encode(0);
}