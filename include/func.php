<?php
//millisecond
function getMilliSecond()
{
    $time = explode(" ", microtime());
    $time = $time [1] . ($time [0] * 1000);
    $time2 = explode(".", $time);
    $times = $time2 [0];
    return $times;
}

//object to array
function object_array($array)
{
    if (is_object($array)) {
        $array = (array)$array;
    }
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            $array[$key] = object_array($value);
        }
    }
    return $array;
}

//mkfile
function mkFile($file)
{
    if (!file_exists($file)) {
        mkdir($file, 0700);
    }
}

//checkEmptyString
function checkEmptyString($emptys)
{
    if (!is_string($emptys)) return false;
    if (empty($emptys)) return false;
    if ($emptys == '') return false;
    return true;
}