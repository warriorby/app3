<?php
header("Content-type: text/html; charset=utf-8");
$id = $_GET['id'];
$t = $_GET['t'];
$page = $_GET['start'];
$pages = $_GET['pages'];

for ($i = $page; $i <= $pages; $i++) {
//$url = "http://www.ruyile.com/xxlb.aspx?id=".$id."&t=".$t."&p=".$i;
    $url = "http://www.ruyile.com/xxlb.aspx?id=37&t=2&p=1";
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//在需要用户检测的网页里需要增加下面两行 
//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
//curl_setopt($ch, CURLOPT_USERPWD, US_NAME.":".US_PWD);
    $contents = curl_exec($ch);
    curl_close($ch);

    $contents = preg_replace("/<(script.*?)>(.*?)<(\/script.*?)>/si", "", $contents); //过滤script标签
    $contents = preg_replace("/<(\/?script.*?)>/si", "", $contents); //过滤script标签
    $contents = preg_replace("/javascript/si", "Javascript", $contents); //过滤script标签
    $contents = preg_replace("/vbscript/si", "Vbscript", $contents); //过滤script标签
    $contents = preg_replace("/on([a-z]+)\s*=/si", "On\\1=", $contents); //过滤script标签
    $contents = preg_replace("/&#/si", "&＃", $contents); //过滤script标签，如javAsCript:alert(

    $contents = preg_replace("/<(applet.*?)>(.*?)<(\/applet.*?)>/si", "", $contents); //过滤applet标签
    $contents = preg_replace("/<(\/?applet.*?)>/si", "", $contents); //过滤applet标签

    $contents = preg_replace("/<(style.*?)>(.*?)<(\/style.*?)>/si", "", $contents); //过滤style标签
    $contents = preg_replace("/<(\/?style.*?)>/si", "", $contents); //过滤style标签

    $contents = preg_replace("/<(title.*?)>(.*?)<(\/title.*?)>/si", "", $contents); //过滤title标签
    $contents = preg_replace("/<(\/?title.*?)>/si", "", $contents); //过滤title标签

    $contents = preg_replace("/<(object.*?)>(.*?)<(\/object.*?)>/si", "", $contents); //过滤object标签
    $contents = preg_replace("/<(\/?objec.*?)>/si", "", $contents); //过滤object标签

    $contents = preg_replace("/<(noframes.*?)>(.*?)<(\/noframes.*?)>/si", "", $contents); //过滤noframes标签
    $contents = preg_replace("/<(\/?noframes.*?)>/si", "", $contents); //过滤noframes标签

    $contents = preg_replace("/<(i?frame.*?)>(.*?)<(\/i?frame.*?)>/si", "", $contents); //过滤frame标签
    $contents = preg_replace("/<(\/?i?frame.*?)>/si", "", $contents); //过滤frame标签

    $contents = preg_replace("/\s+/", " ", $contents); //过滤多余回车
    $contents = preg_replace("/<[ ]+/si", "<", $contents); //过滤<__("<"号后面带空格)

    $contents = preg_replace("/<\!--.*?-->/si", "", $contents); //注释
    $contents = preg_replace("/<(\!.*?)>/si", "", $contents); //过滤DOCTYPE
    $contents = preg_replace("/<(\/?html.*?)>/si", "", $contents); //过滤html标签
    $contents = preg_replace("/(?=href=)([^\>]*)(?=\>)/i", "", $contents); //过滤a标签
    $contents = preg_replace("/<(\/?head.*?)>/si", "", $contents); //过滤head标签
    $contents = preg_replace("/<(\/?meta.*?)>/si", "", $contents); //过滤meta标签
    $contents = preg_replace("/<(\/?body.*?)>/si", "", $contents); //过滤body标签

    $contents = preg_replace("/<(div class=\"top\".*?)>(.*?)<(\/div.*?)>/si", "", $contents); //过滤body标签
    $contents = preg_replace("/<(div class=\"left_300 left\".*?)>(.*?)<(\/div.*?)>/si", "", $contents); //过滤body标签
    $contents = preg_replace("/<(div class=\"main\".*?)>(.*?)<(\/div.*?)>/si", "", $contents); //过滤body标签
    $contents = preg_replace("/<(div class=\"quyu_list\".*?)>(.*?)<(\/div.*?)>/si", "", $contents); //过滤body标签
    $contents = preg_replace("/<(div class=\"search_left right img_border\".*?)>(.*?)<(\/div.*?)>/si", "", $contents); //过滤body标签
    $contents = preg_replace("/<(div class=\"no_way\".*?)>(.*?)<(\/div.*?)>/si", "", $contents);
    $contents = preg_replace("/<(div class=\"left_298 top_border\".*?)>(.*?)<(\/div.*?)>/si", "", $contents);
    $contents = preg_replace("/<(div class=\"search_right right\".*?)>(.*?)<(\/div.*?)>/si", "", $contents);
    $contents = preg_replace("/<(div class=\"right_top\".*?)>(.*?)<(\/div.*?)>/si", "", $contents);
    $contents = preg_replace("/<(div style=\"height:0px;overflow:hidden;\".*?)>(.*?)<(\/div.*?)>/si", "", $contents);
    $contents = preg_replace("/<(div class=\"right_650 right\".*?)>(.*?)<(\/div.*?)>/si", "", $contents);
    $contents = preg_replace("/<(div class=\"right\".*?)>(.*?)<(\/div.*?)>/si", "", $contents);
    $contents = preg_replace("/<(div class=\"page\".*?)>(.*?)<(\/div.*?)>/si", "", $contents);
    $contents = preg_replace("/<(h3.*?)>(.*?)<(\/h3.*?)>/si", "", $contents);
    $contents = preg_replace("/<(p.*?)>(.*?)<(\/p.*?)>/si", "", $contents);
    $contents = strip_tags($contents, "<h2>");
    $contents = preg_replace("/<(h2)>/si", "", $contents);
    $contents = preg_replace("/<(\/h2)>/si", "<br>", $contents);

    echo $contents;
}