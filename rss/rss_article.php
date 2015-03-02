<?php
header("Content-type: text/html;charset=UTF-8");
require __DIR__ . "/../config/conn2.php";
require __DIR__ . '/../include/get_data.php';

$nid = $arr['nid'];
if (isset($nid)) {
    $rs_arr = $d3b->select("node", ["title", "created", "comment"], ["nid" => $nid]);
    $title = $rs_arr[0]["title"];
    $created = $rs_arr[0]["created"];
    $comment = $rs_arr[0]["comment"];
    $rs2_arr = $d3b->select("field_data_body", ["body_value"], ["entity_id" => $nid]);
    $body_value = $rs2_arr[0]['body_value'];
    echo $body_value;
    //$return_arr = ["title"=>$title,"body_value"=>$body_value];
   // require __DIR__.'/../include/return_data.php';
} else {
    echo json_encode(0);
}