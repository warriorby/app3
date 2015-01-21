<?php
require("../include/conn.php");
require("../include/get_data.php");

$tid = $arr['tid'];
$uid = $arr['uid'];
$star_level = $arr['star_level'];
$comment = $arr['comment'];
if (isset($tid) && isset($uid) && isset($star_level) && isset($comment)) {
    $timestamp = time();
    $d2b->update("task_main",["star_level"=>$star_level,"comment"=>$comment,"updated"=>$timestamp],["AND"=>["uid"=>$uid,"tid"=>$tid]]);
    $return_arr = array("tid" => $tid, "uid" => $uid, "star_level" => $star_level, "comment" => $comment);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}
