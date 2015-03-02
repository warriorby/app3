<?php
require("../include/conn.php");
require("../include/get_data.php");
require("../include/func.php");
$uid = $arr['uid'];
if (isset($uid)) {
    $sql = "select * from task_main where uid=$uid and task_status=3 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";
    $sql2 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=1 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";
    $sql3 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=2 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";
    $sql4 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=3 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";
    $sql5 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=4 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";
    $sql6 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=5 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";
    $sql7 = "select * from task_main a LEFT JOIN task_profile b on a.name_type_id=b.name_type_id where a.uid=$uid and a.task_status=3 and b.task_type=6 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(FROM_UNIXTIME(end_time))";

    //total
    $rs = $d2b->query($sql);
    $rs_arr = $rs->fetchAll(PDO::FETCH_ASSOC);
    $week_count = 0;
    foreach ($rs_arr as $key => $value) {
        $week_count += $value['cost_time'];
    }

    //task_type=1
    $rs2 = $d2b->query($sql2);
    $rs2_arr = $rs2->fetchAll(PDO::FETCH_ASSOC);
    $study_count = 0;
    foreach ($rs2_arr as $key => $value) {
        $study_count += $value['cost_time'];
    }

    //task_type=2
    $rs3 = $d2b->query($sql3);
    $rs3_arr = $rs3->fetchAll(PDO::FETCH_ASSOC);
    $sports_count = 0;
    foreach ($rs3_arr as $key => $value) {
        $sports_count += $value['cost_time'];
    }

    //task_type=3
    $rs4 = $d2b->query($sql4);
    $rs4_arr = $rs4->fetchAll(PDO::FETCH_ASSOC);
    $play_count = 0;
    foreach ($rs4_arr as $key => $value) {
        $play_count += $value['cost_time'];
    }

    //task_type=4
    $rs5 = $d2b->query($sql5);
    $rs5_arr = $rs5->fetchAll(PDO::FETCH_ASSOC);
    $life_count = 0;
    foreach ($rs5_arr as $key => $value) {
        $life_count += $value['cost_time'];
    }

    //task_type=5
    $rs6 = $d2b->query($sql6);
    $rs6_arr = $rs6->fetchAll(PDO::FETCH_ASSOC);
    $talent_count = 0;
    foreach ($rs6_arr as $key => $value) {
        $talent_count += $value['cost_time'];
    }

    //task_type=6
    $rs7 = $d2b->query($sql7);
    $rs7_arr = $rs7->fetchAll(PDO::FETCH_ASSOC);
    $read_count = 0;
    foreach ($rs7_arr as $key => $value) {
        $read_count += $value['cost_time'];
    }
    $week_total = 48 * 60;
    $study_time = 23*60;
    $sports_time =6.5*60;
    $play_time = 6.5*60;
    $life_time = 2*60;
    $talent_time = 5.5*60;
    $read_time = 4.5*60;
    //study
    $study_descr1='在学习上的时间投入过多，很努力很值得肯定，同时注意学习效率哦~';
    $study_descr2 = '学习时间管理非常优秀';
    $study_descr3='学习时间管理良好';
    $study_descr4='学习时间管理能力有待提高哦，继续努力吧';
    $study_descr=type_descr($study_count,$study_time,$study_descr1,$study_descr2,$study_descr3,$study_descr4);

    //sports
    $sports_descr1='很喜欢运动，很有运动天赋哦~';
    $sports_descr2='运动花的时间很多';
    $sports_descr3='运动花的时间良好';
    $sports_descr4='活动时间太少，注意劳逸结合哦~';
    $sports_descr=type_descr($sports_count,$sports_time,$sports_descr1,$sports_descr2,$sports_descr3,$sports_descr4);

    //play
    $play_descr1='娱乐时间非常多，别光顾着玩哦~';
    $play_descr2='娱乐时间很多，。。';
    $play_descr3='娱乐时间良好。。';
    $play_descr4='娱乐时间很少，注意牢记结合哦~';
    $play_descr=type_descr($play_count,$play_time,$play_descr1,$play_descr2,$play_descr3,$play_descr4);

    //life
    $life_descr1='真是个独立的孩子，热爱生活吧~';
    $life_descr2='爱做家务的孩子，加来更加独立哦~';
    $life_descr3='';
    $life_descr4='家务做得太少，要多帮父母一起做家务哦';
    $life_descr=type_descr($life_count,$life_time,$life_descr1,$life_descr2,$life_descr3,$life_descr4);

    //talent
    $talent_descr1='很擅长才艺，要好好培养自己的特长哦~';
    $talent_descr2='才艺花的时间很多，期待你的表演哦~';
    $talent_descr3='才艺花的时间还行，要坚持自己的兴趣哦~';
    $talent_descr4='才艺花的时间很少，没有喜欢的才艺吗？';
    $talent_descr = type_descr($talent_count,$talent_time,$talent_descr1,$talent_descr2,$talent_descr3,$talent_descr4);

    //read
    $read_descr1='阅读时间非常多，注意保护眼睛哦~  ';
    $read_descr2='阅读时间很多，注意质量哦~';
    $read_descr3='';
    $read_descr4='阅读时间太少哦，多看书会有意想不到的收获哦~';
    $read_descr = type_descr($read_count,$read_time,$read_descr1,$read_descr2,$read_descr3,$read_descr4);

    $return_arr = ["uid" => $uid, "week_total" =>$week_total,"week_count" => $week_count,"study_count" => $study_count,"sports_count" => $sports_count,"play_count" => $play_count,
                "life_count" => $life_count,"talent_count" => $talent_count,"read_count" => $read_count,
    "study_descr"=>$study_descr,"sports_descr"=>$sports_descr,"play_descr"=>$play_descr,"life_descr"=>$life_descr,"talent_descr"=>$talent_descr,
    "read_descr"=>$read_descr];
    include "../include/return_data.php";
} else {
    echo json_encode(0);
}