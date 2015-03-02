<?php
//millisecond毫秒
function getMilliSecond()
{
    $time = explode(" ", microtime());
    $time = $time [1] . ($time [0] * 1000);
    $time2 = explode(".", $time);
    $times = $time2 [0];
    return $times;
}

//微秒microsecond
function getMicroSecond()
{
    $time = explode(" ", microtime());
    $time = $time [1] . ($time [0] * 1000000);
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

//descr
function type_descr($count, $time,$descr,$descr2,$descr3,$descr4)
{
    if ($time > $count && $count >= ($time * 0.7)) {
        return $descr2;
    } elseif (($time * 0.7) > $count && $count >= ($time * 04)) {
        return $descr3;
    } elseif (($time * 0.4) > $count) {
        return $descr4;
    } else {
        return $descr;
    }
}