<?php
require("../include/conn.php");
require("../include/get_data.php");
require '../include/func.php';

$uid_c = $arr['uid'];
if (isset($uid_c)) {
    $micorTime = getMicroSecond();
    $code_key = sha1($micorTime);
    $d2b->insert("key_list", ["code_key" => $code_key, "uid_c" => $uid_c]);
    echo $code_key;
} else {
    echo json_encode(0);
}
