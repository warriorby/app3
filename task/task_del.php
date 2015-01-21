<?php
require("../include/conn.php");
require("../include/get_data.php");

$tid = $arr['tid'];
$uid = $arr['uid'];

if (isset($tid) && isset($uid)) {
    $d2b->delete("task_main", ["AND" => [
        "tid" => $tid, "uid" => $uid
    ]
    ]);

    $d2b->delete("task_log", ["AND" => [
        "tid" => $tid, "uid" => $uid
    ]
    ]);

    $return_arr = array("uid" => $uid);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}


