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
            $d2b->update("user_main", ["channelid" =>null], ["uid" => $uid_p]);
            $d2b->update("user_main", ["channelid" =>null], ["uid" => $uid_c]);
            $d2b->update("user_profile", [ "real_name" => $realName_p,"rel"=>$rel,"sex" => $sex_p, "birth" => $birth],["uid" => $uid_p]);
            $d2b->update("user_profile", [ "real_name" => $realName_c, "sex" => $sex_c, "birth" => $birth],["uid" => $uid_c]);

            //判断学校是否修改
            $rs3_arr = $d2b->select("user_education",["pid","zid","cid","sid","gid","class_id"],["uid"=>$uid_p]);
            if($gid!=$rs3_arr[0]['gid'] || $class_id!=$rs3_arr[0]['class_id']){
                $rs4_arr = $d2b->select("user_im_group","*",["uid"=>$uid_p]);
                require_once("../IM/im_init.php");
                 $easeMob->delGroupsUser($rs4_arr[0]['group_gid'],$uid_p);
                 $easeMob->delGroupsUser($rs4_arr[0]['group_classid'],$uid_p);
                include "../user/parent_imReg.php";
                $d2b->update("user_education",["pid"=>$pid,"zid"=>$zid,"cid"=>$cid,"sid"=>$sid,"gid"=>$gid,"class_id"=>$class_id],["uid"=>$uid_p]);
                $d2b->update("user_education",["pid"=>$pid,"zid"=>$zid,"cid"=>$cid,"sid"=>$sid,"gid"=>$gid,"class_id"=>$class_id],["uid"=>$uid_c]);

                $return_arr= ["uid_c" => $uid_c,"uid_p"=>$uid_p,"real_name_p"=>$realName_p,"real_name_c"=>$realName_c, "sex_p"=>$sex_p,"sex_c"=>$sex_c,
                    "birth"=>$birth,"role"=>$role,
                    "to_groupGid" => $to_groupGid, "to_groupClassId" => $to_groupClassId];
            }else{
                $return_arr =  ["uid_c" => $uid_c,"uid_p"=>$uid_p,"real_name_p"=>$realName_p,"real_name_c"=>$realName_c, "sex_p"=>$sex_p,"sex_c"=>$sex_c,
                    "birth"=>$birth,"role"=>$role
                   ];
            }
            break;
        case 2:
            $d2b->update("user_main", ["channelid" =>null], ["uid" => $uid_c]);
            $rs_arr = $d2b->select("user_relation",["to_uid"],["uid_c"=>$uid_c]);
            $to_uid = $rs_arr[0]['to_uid'];
            if($uid_p != 0){
                $d2b->update("user_main", ["channelid" =>null], ["uid" => $to_uid]);
            }
            $d2b->update("user_profile", [ "real_name" => $realName_c, "sex" => $sex_c, "birth" => $birth],["uid" => $uid_c]);

            //判断学校是否修改
            $rs5_arr = $d2b->select("user_education",["pid","zid","cid","sid","gid","class_id"],["uid"=>$uid_c]);
            if($gid!=$rs5_arr[0]['gid'] || $class_id!=$rs5_arr[0]['class_id']){
                $rs6_arr = $d2b->select("user_im_group",["*"],["uid"=>$uid_c]);
                require_once("../IM/im_init.php");
                $easeMob->delGroupsUser($rs6_arr[0]['group_gid'],$uid_c);
                $easeMob->delGroupsUser($rs6_arr[0]['group_classid'],$uid_c);
                include "../user/chilren_imReg.php";
                $d2b->update("user_education",["pid"=>$pid,"zid"=>$zid,"cid"=>$cid,"sid"=>$sid,"gid"=>$gid,"class_id"=>$class_id],["uid"=>$uid_c]);

                $return_arr= ["real_name_c" => $realName_c,"group_gid" => $group_gid, "group_classid" => $group_classId];
            }else{
                $return_arr = ["real_name_c" => $realName_c];
            }
            break;
        default:
            echo json_encode(0);
            break;
    }
    include("../include/return_data.php");
} else {
    echo json_encode(0);
}