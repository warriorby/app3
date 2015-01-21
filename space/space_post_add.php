<?php
require "../include/upload_dir.php";
require "../include/func.php";

mkFile($post_upload);
if ($_FILES["filename"]["name"]) {
    $img_name = basename($_FILES["filename"]["name"]);
    $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
    $timestamp = getMilliSecond();
    $post_new_name = $timestamp . "P." . $img_extension;
    $post_url = $post_upload . $post_new_name;
    move_uploaded_file($_FILES["filename"]["tmp_name"], $post_url);

    echo $post_new_name;
}else{
    echo json_encode(0);
}
