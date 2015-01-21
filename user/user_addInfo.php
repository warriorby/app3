<?php
require("../include/conn.php");
require("../include/get_data.php");

$sex_c = $arr['sex_c'];
$birth = $arr['birth'];
$pid = $arr['pid'];
$cid = $arr['cid'];
$zid = $arr['zid'];
$sid = sprintf("%03d",$arr['sid']);
$gid = sprintf("%02d",$arr['gid']);
$class_id = $arr['class_id'];
$realName_c = $arr['real_name_c'];
$uid_c = $arr['uid_c'];
$role = $arr['role'];
$school_type = $arr['school_type'];
if (isset($role)) {
    $timestamp = time();
    switch ($role) {
        case 1:
            $rel = $arr['rel'];
            $sex_p = $arr['sex_p'];
            $uid_p = $arr['uid_p'];
            $realName_p = $arr['real_name_p'];
            $d2b->update("user_profile", [ "real_name" => $realName_p,"rel"=>$rel,"sex" => $sex_p, "birth" => $birth],["uid" => $uid_p]);
            $d2b->update("user_profile", [ "real_name" => $realName_c, "sex" => $sex_c, "birth" => $birth],["uid" => $uid_c]);
            $d2b->update("user_education",["pid"=>$pid,"zid"=>$zid,"cid"=>$cid,"sid"=>$sid,"gid"=>$gid,"class_id"=>$class_id],["uid"=>$uid_p]);
            $d2b->update("user_education",["pid"=>$pid,"zid"=>$zid,"cid"=>$cid,"sid"=>$sid,"gid"=>$gid,"class_id"=>$class_id],["uid"=>$uid_c]);
            $d2b->update("clazz_list",["stu_count[+]"=>1,"t_count"=>1],["class_id"=>$class_id]);
            include "parent_imReg.php";
            $return_arr= ["uid_c" => $uid_c,"uid_p"=>$uid_p,"real_name_p"=>$realName_p,"real_name_c"=>$realName_c, "to_groupGid" => $to_groupGid, "to_groupClassId" => $to_groupClassId];
            break;
        case 2:
            $d2b->update("user_profile", [ "real_name" => $realName_c, "sex" => $sex_c, "birth" => $birth],["uid" => $uid_c]);
            $d2b->update("user_education",["pid"=>$pid,"zid"=>$zid,"cid"=>$cid,"sid"=>$sid,"gid"=>$gid,"class_id"=>$class_id],["uid"=>$uid_c]);
            $d2b->update("clazz_list",["stu_count[+]"=>1,"t_count"=>1],["class_id"=>$class_id]);
            include "chilren_imReg.php";
            $return_arr= ["real_name_c" => $realName_c,"group_gid" => $group_gid, "group_classid" => $group_classId];
            break;
        default:
            echo json_encode(0);
            break;
    }
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}