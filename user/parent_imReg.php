<?php
require_once("../IM/im_init.php");
include "../im/im-group.php";
//grade
if (empty($to_groupGid)) {
    $option = ["groupname" => "同级家长群", "desc" => "同级家长", "public" => true, "maxusers" => 300, "owner" => $uid_p];
    $datas = $easeMob->createGroups($option);
    $to_groupGid = $datas['data']['groupid'];
} else {
    $easeMob->addGroupsUser($to_groupGid, $uid_p);
}
$local_toGroupGid = $cid . $zid . $school_type . $sid . "1" . $gid . "00";
$d2b->update("im_group", ["to_group_id" => $to_groupGid, "local_to_group" => $local_toGroupGid], ["AND" => ["zid" => $zid, "sid" => $sid, "gid" => $gid, "class_id" => "00"]]);

//class
if (empty($to_groupClassId)) {
    $option2 = ["groupname" => "同班家长群", "desc" => "同班家长", "public" => true, "maxusers" => 300, "owner" => $uid_p];
    $datas2 = $easeMob->createGroups($option2);
    $to_groupClassId = $datas2['data']['groupid'];
} else {
    $easeMob->addGroupsUser($to_groupClassId, $uid_p);
}
$local_toGroupclassid = $cid . $zid . $school_type . $sid . "1" . $gid . $class_id;
$d2b->update("im_group", ["to_group_id" => $to_groupClassId, "local_to_group" => $local_toGroupclassid], ["AND" => ["zid" => $zid, "sid" => $sid, "gid" => $gid, "class_id" => $class_id]]);
$d2b->update("user_im_group", ["group_gid" => $to_groupGid, "group_classid" => $to_groupClassId], ["uid" => $uid_p]);


