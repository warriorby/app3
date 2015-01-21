<?php
require("../include/conn.php");
require("../include/get_data.php");

$zid = $arr['zid'];
$sid = sprintf("%03d",$arr['sid']); //001
$gid = sprintf("%02d",$arr['gid']); //01
$class_id = $arr['class_id'];
if(isset($zid) && isset($sid) && isset($gid) && isset($class_id)){
    $data = $d2b->select("school_list",["school"],["AND"=>["zid"=>$zid,"sid"=>$sid]]);
    $school = $data[0]['school'];
    $data2 = $d2b->select("grade_list",["grade"],["gid"=>$gid]);
    $grade = $data2[0]['grade'];
    $data3 = $d2b->select("clazz_list",["cname"],["AND"=>["class_id"=>$class_id,"zid"=>$zid,"sid"=>$sid,"gid"=>$gid]]);
    $cname = $data3[0]['cname'];
    $class_name = $school.$grade.$cname;
    $return_arr = ["cname"=>$class_name];
    include("../include/return_data.php");
}else{
    echo json_encode(0);
}