<?php
require("../include/conn.php");
require("../include/get_data.php");

if(isset($arr)){
$result_arr = array();
foreach($arr as $row){
    $sub_arr = array();
   // print_r($row);
    $uid = $row['uid'];
   // echo $uid;

    $rs_arr = $d2b->select("user_profile",["real_name","sex"],["uid"=>$uid]);
    $real_name = $rs_arr[0]['real_name'];
    $sex = $rs_arr[0]['sex'];

    $rs_arr2 = $d2b->select("user_avatar",["avatar"],["uid"=>$uid]);
    if(count($rs_arr2)!=0){
    $avatar_name = $rs_arr2[0]['avatar'];
    }else{
        $avatar_name=null;
    }
    $sub_arr["uid"]=$uid;
    $sub_arr["nickname"]=$real_name;
    $sub_arr["avatar"]=$avatar_name;
    $sub_arr['sex']=$sex;
    $result_arr[]=$sub_arr;
}
    $return_arr = $result_arr;
    include("../include/return_data.php");
}else{
    echo json_encode(0);
}