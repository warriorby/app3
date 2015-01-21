<?php
require("../include/conn.php");
require("../include/get_data.php");

	$uid = $arr['uid'];
	$exper_content = $arr['exper_content'];

if(isset($uid) && isset($exper_content)){
	$timestamp = time();
    $eid = $d2b->insert("space_exper",["uid"=>$uid,"exper_content"=>$exper_content,"updated"=>$timestamp]);
	$return_arr = array("uid"=>$uid,"exper_content"=>$exper_content,"eid"=>$eid);
    include("../include/return_data.php");
}else{
    echo json_encode(0);
}
