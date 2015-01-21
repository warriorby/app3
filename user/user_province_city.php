<?php
require("../include/conn.php");
require "../include/get_data.php";

$pid = $arr['pid'];
if (isset($pid)) {
    $return_arr = $d2b->select("city_list","*",["pid"=>$pid]);
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}