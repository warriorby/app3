<?php
require("../IM/im_init.php");
include "../im/im-group.php";
//grade
if (empty($group_gid)) {
    $option = ["groupname" => "同级同学群", "desc" => "同级同学", "public" => true, "maxusers" => 300, "owner" => $uid_c];
    $datas = $easeMob->createGroups($option);
    $group_gid = $datas['data']['groupid'];
} else {
    $easeMob->addGroupsUser($group_gid, $uid_c);
}
$local_groupGid = $cid . $zid . $school_type . $sid . "2" . $gid . "00";
$d2b->update("im_group", ["group_id" => $group_gid, "local_group_id" => $local_groupGid], ["AND" => ["zid" => $zid, "sid" => $sid, "gid" => $gid, "class_id" => "00"]]);

//class
if (empty($group_classId)) {
    $option2 = ["groupname" => "同班同学群", "desc" => "同班同学", "public" => true, "maxusers" => 300, "owner" => $uid_c];
    $datas2 = $easeMob->createGroups($option2);
    $group_classId = $datas2['data']['groupid'];
} else {
    $easeMob->addGroupsUser($group_classId, $uid_c);
}
$local_groupClassid = $cid . $zid . $school_type . $sid . "2" . $gid . $class_id;
$d2b->update("im_group", ["group_id" => $group_classId, "local_group_id" => $local_groupClassid], ["AND" => ["zid" => $zid, "sid" => $sid, "gid" => $gid, "class_id" => $class_id]]);
$d2b->update("user_im_group", ["group_gid" => $group_gid, "group_classid" => $group_classId], ["uid" => $uid_c]);


