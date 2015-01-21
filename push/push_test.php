<?php
require_once 'vendor/autoload.php';
require "../include/conn.php";
require "../include/get_data.php";
use JPush\Model as M;
use JPush\JPushClient;
use JPush\JPushLog;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use JPush\Exception\APIConnectionException;
use JPush\Exception\APIRequestException;

$uid = $arr['uid'];
$msg = $arr['msg'];
$role = $arr['role'];

$master_secret_c = '24a6bb3051447e0b644021ef';
$app_key_c = '6cede177da188c2915f3dcb7';
$master_secret_p = 'c48e23b33f6a0065fce06e59';
$app_key_p = '0770fce0d05d7f5baf88dae7';

JPushLog::setLogHandlers(array(new StreamHandler('jpush.log', Logger::DEBUG)));
if (isset($uid) && isset($msg) && isset($role)) {
    $rs_arr = $d2b->select("user_main", ["channelid"], ["uid" => $uid]);
    $channelid = $rs_arr[0]['channelid'];
    if($channelid != null){
    switch ($role) {
        case 1:
            $client = new JPushClient($app_key_c, $master_secret_c);
            try {
                $result = $client->push()
                    ->setPlatform(M\platform('ios', 'android'))
                    ->setAudience(M\audience(M\registration_id(array($channelid))))
                    ->setNotification(M\notification($msg, M\android($msg), M\ios($msg, 'happy', 1, true, null, 'THE-CATEGORY')))
                    ->setMessage(M\message($msg, null, null, array('key' => 'value')))
                    ->setOptions(M\options(123456, null, null, false, 0))
                    ->send();

                $return_arr = ["channelid" => $channelid];
                include "../include/return_data.php";
            } catch (APIRequestException $e) {
                echo 'code : ' . $e->code;
            }
            break;
        case 2:
            $client = new JPushClient($app_key_p, $master_secret_p);
            try {
                $result = $client->push()
                    ->setPlatform(M\platform('ios', 'android'))
                    ->setAudience(M\audience(M\registration_id(array($channelid))))
                    ->setNotification(M\notification($msg, M\android($msg), M\ios($msg, 'happy', 1, true, null, 'THE-CATEGORY')))
                    ->setMessage(M\message($msg, null, null, array('key' => 'value')))
                    ->setOptions(M\options(123456, null, null, false, 0))
                    ->send();

                $return_arr = ["channelid" => $channelid];
                include "../include/return_data.php";
            } catch (APIRequestException $e) {
                echo 'code : ' . $e->code;
            }
            break;
        default:
            echo json_encode(0);
            break;
    }
    }else{
        echo json_encode(-106);
    }
} else {
    echo json_encode(0);
}