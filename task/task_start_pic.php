<?php
require("../include/upload_dir.php");
require("../include/func.php");

if (!file_exists($img_upload)) {
    mkdir("$img_upload", 0700);
}

if ($_FILES["filename"]["name"]) {
    $img_name = basename($_FILES["filename"]["name"]);
    $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);

    $timestamp = getMilliSecond();
    $img_new_name = $timestamp . "T_START." . $img_extension;
    $img_url = $img_upload . $img_new_name;
    move_uploaded_file($_FILES["filename"]["tmp_name"], $img_url);

    echo $img_new_name;
} else {
    echo json_encode(0);
}



