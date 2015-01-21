<?php
require("../include/connection.php");
require("../include/get_data.php");

	$tid = $arr["tid"];
	$uid = $arr["uid"];

	if($tid != null && $uid != null){
		$timestamp = time();
		$sql = "update task_log set pause_time = $timestamp, pause_count = pause_count+1 where tid = $tid and uid = $uid";
		$db->exec($sql);

		$return_arr = array("uid"=>$uid, "tid"=>$tid);

        include("../include/return_data.php");
	}else{
        echo json_encode(0);
	}