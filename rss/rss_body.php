<?php
require __DIR__ . "/../config/conn2.php";
require __DIR__ . '/../include/get_data.php';

$nid = $arr['nid'];
if (isset($nid)) {
    $rs_arr = $d3b->select("node", ["type", "uid", "created"], ["nid" => $nid]);
    $type = $rs_arr[0]["type"];
    $uid = $rs_arr[0]["uid"];
    $created = $rs_arr[0]["created"];
    $site = 'http://weshare100.com/'.$type.'/'.$uid.'/'.$created;
    echo $site;
} else {
    echo json_encode(0);
}