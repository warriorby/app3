<?php
require "../include/conn.php";
require "../include/get_data.php";

$task_name = $arr['task_name'];
$task_type=$arr['task_type'];

if(isset($task_type) && isset($task_name)){
    $rs_arr = $d2b->select("task_profile",["name_type_id"],["AND"=>["task_type"=>$task_type,"task_name"=>$task_name]]);
     //echo count($rs_arr);
    if(count($rs_arr) == 0){
        $name_type_id = $d2b->insert("task_profile",["task_name"=>$task_name,"task_type"=>$task_type]);
    }else{
        $name_type_id = $rs_arr[0]['name_type_id'];
    }

    $return_arr = ["name_type_id"=>$name_type_id];
    include "../include/return_data.php";
}else{
    echo json_encode(0);
}