<?php
require 'reader.php';
require '../include/connection.php';
require("../include/upload_dir.php");
require("../include/func.php");

mkFile($excel_upload);

if ($_FILES["filename"]["name"]) {
    $excel_name = basename($_FILES["filename"]["name"]);
    $excel_extension = pathinfo($excel_name, PATHINFO_EXTENSION);

    $timestamp = getMilliSecond();
    $excel_new_name = $timestamp . "SL." . $excel_extension;
    $excel_url = $excel_upload . $excel_new_name;
    move_uploaded_file($_FILES["filename"]["tmp_name"], $excel_url);
} else {
    echo 0;
}
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('gbk');
$data->read($excel_new_name);
error_reporting(E_ALL ^ E_NOTICE);
for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
    $sql2 = "select * from school_list where cid='".$data->sheets[0]['cells'][$i][2]."' and school like '" . $data->sheets[0]['cells'][$i][4] . "'";
    $rs = $db->query($sql2);
    $rs_arr = $rs->fetchAll(PDO::FETCH_ASSOC);
    if (count($rs_arr) == 0) {
        $sql = "INSERT INTO school_list(sid,cid,zid,school,school_type) VALUES('" .
            $data->sheets[0]['cells'][$i][1] . "','" .
            $data->sheets[0]['cells'][$i][2] . "','" .
            $data->sheets[0]['cells'][$i][3] . "','" .
            $data->sheets[0]['cells'][$i][4] . "','" .
            $data->sheets[0]['cells'][$i][5] . "
')";
        $db->exec($sql);
        for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
            echo "\"" . $data->sheets[0]['cells'][$i][$j] . "\",";
        }
        echo "<br/>";
    } else {
        echo $data->sheets[0]['cells'][$i][4] . 'school exits';
        echo "<br/>";
    }
}

$sql3 = "delete from school_list where school_type=0";
$db->exec($sql3);

unlink($excel_new_name);

