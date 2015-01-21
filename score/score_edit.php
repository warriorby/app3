<?php
require "../include/conn.php";
require "../include/get_data.php";

$score_id = $arr['score_id'];
$score = $arr['score'];
$average = $arr['average'];
$total = $arr['total'];
$exam_date = $arr['exam_date'];

if (isset($score) && isset($score_id) && isset($average) && isset($total) && isset($exam_date)) {
    $timestamp = time();
    $d2b->update("score_main", ["score" => $score, "average" => $average, "total" => $total, "exam_date" => $exam_date, "updated" => $timestamp], ["score_id" => $score_id]);
    $return_arr = ["score_id" => $score_id];
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}