<?php
require("../include/conn.php");
require("../include/get_data.php");

$key_word = $arr['key_word'];
if (isset($key_word)) {
    $sql = "select * from province_list where province like '%$key_word%'";
    $rs = $d2b->query($sql);
    $return_arr = $rs->fetchAll(PDO::FETCH_ASSOC);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}