<?php
require "../include/SendTemplateSMS.php";
require("../include/conn.php");
require "../include/get_data.php";

$phone = $arr['phone'];
$auth_code = rand(1000, 9999);
if (isset($phone)) {
    $data = $d2b->select("user_main",["phone"],["phone"=>$phone]);
    if(count($data)==0) {
        sendTemplateSMS($phone, array($auth_code), 10913);
        $return_arr = ["phone" => $phone, "auth_code" => (string)$auth_code];
        include "../include/return_data.php";
    }else{
        echo json_encode(-101);
    }
} else {
    echo json_encode(0);
}