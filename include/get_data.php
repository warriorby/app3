<?php
if(isset($_GET["data"])){
    $json_str=$_GET["data"];
}else{
    @$json_str=$_POST["data"];
}
    $arr = @json_decode($json_str,ture);