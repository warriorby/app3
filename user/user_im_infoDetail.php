<?php
require "../include/conn.php";
require "../include/get_data.php";

$uid = $arr['uid'];
if(isset($uid)){
    $rs2_arr = $d2b->select("user_education",["cid","zid","sid","gid","class_id"],["uid"=>$uid]);
    $cid = $rs2_arr[0]['cid'];
    $zid = $rs2_arr[0]['zid'];
    $sid = $rs2_arr[0]['sid'];
    $gid = $rs2_arr[0]['gid'];
    $class_id=$rs2_arr[0]['class_id'];

    $rs3_arr = $d2b->select("city_list",["city"],["cid"=>$cid]);
    $city = $rs3_arr[0]['city'];

    $rs4_arr = $d2b->select("zone_list",["zone"],["zid"=>$zid]);
    $zone = $rs4_arr[0]['zone'];

    $rs5_arr = $d2b->select("school_list",["school"],["zid"=>$zid]);
    $school = $rs5_arr[0]['school'];

    $rs6_arr = $d2b->select("clazz_list",["cname"],["class_id"=>$class_id]);
    $cname = $rs6_arr[0]['cname'];
    $return_arr = ['uid'=>$uid,'city'=>$city,'zone'=>$zone,'school'=>$school,'grade'=>$gid,'className'=>$cname];
    include "../include/return_data.php";
}else{
    echo json_encode(0);
}