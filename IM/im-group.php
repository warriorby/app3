<?php
$rs_arr =$d2b->select("im_group","*",["AND"=>["zid"=>$zid,"sid"=>$sid,"gid"=>$gid,"class_id"=>"00"]]);
if(count($rs_arr)==0){
    $d2b->insert("im_group",["zid"=>$zid,"sid"=>$sid,"gid"=>$gid,"class_id"=>"00"]);
    $group_gid = '';
    $to_groupGid = '';
}else{
    $group_gid = $rs_arr[0]['group_id'];
    $to_groupGid = $rs_arr[0]['to_group_id'];
}

$rs2_arr =$d2b->select("im_group","*",["AND"=>["zid"=>$zid,"sid"=>$sid,"gid"=>$gid,"class_id"=>$class_id]]);
if(count($rs2_arr)==0){
    $d2b->insert("im_group",["zid"=>$zid,"sid"=>$sid,"gid"=>$gid,"class_id"=>$class_id]);
    $group_classId = '';
    $to_groupClassId = '';
}else{
    $group_classId = $rs2_arr[0]['group_id'];
    $to_groupClassId = $rs2_arr[0]['to_group_id'];
}