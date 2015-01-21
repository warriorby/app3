<?php
require "../include/conn.php";

$return_arr = $d2b->select("province_list","*");
include "../include/return_data.php";