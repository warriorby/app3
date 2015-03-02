<?php
require __DIR__."/../config/conn2.php";
require __DIR__.'/../include/get_data.php';

//$sql = "SELECT * from node where TO_DAYS(FROM_UNIXTIME(created))=TO_DAYS(NOW()) ";
$sql = "select * from node ORDER BY created DESC LIMIT 9";
$rs = $d3b->query($sql);
$rs_arr = $rs->fetchAll(PDO::FETCH_ASSOC);
//$rs_arr = $d3b->select("node",["nid","title","created","comment","uid"]);
foreach($rs_arr as $row){
    $nid = $row["nid"];
    $title = $row["title"];
    $created = $row["created"];
    $comment = $row["comment"];
    $uid = $row['uid'];
    $rs2_arr = $d3b->select("users",["name"],["uid"=>$uid]);
    $name = $rs2_arr[0]['name'];
    $return_arr[] = ["nid"=>$nid,"title"=>$title,"created"=>$created,"comment"=>$comment,"name"=>$name];
}
require __DIR__.'/../include/return_data.php';