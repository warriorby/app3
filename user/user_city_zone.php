<?php
require "../include/conn.php";
require "../include/get_data.php";

$cid = $arr['cid'];
if(isset($cid)){
    $return_arr = $d2b->select("zone_list","*",["cid"=>$cid]);
    include "../include/return_data.php";
}else{
    echo json_encode(0);
}