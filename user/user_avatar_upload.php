<?php
require("../include/upload_dir.php");
require("../include/func.php");

mkFile($avatar_upload);

if ($_FILES["filename"]["name"]) {
    $avatar_name = basename($_FILES["filename"]["name"]);
    $avatar_extension = pathinfo($avatar_name, PATHINFO_EXTENSION);
    $times = getMilliSecond();
    $avatar_new_name = $times. "A." . $avatar_extension;
    var_dump($avatar_new_name);
    $avatar_url = $avatar_upload . $avatar_new_name;
    move_uploaded_file($_FILES["filename"]["tmp_name"], $avatar_url);

    echo $avatar_new_name;
} else {
    echo json_encode(0);
}



