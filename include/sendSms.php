<?php     

	include_once('HttpClient.class.php');

	$Client = new HttpClient("mssms.cn:8000");

$auth_code = rand(1000,9999);
	$params = array('username'=>"JSMB260519",'scode'=>"321791",'mobile'=>"15800651149",'content'=>"@1@=$auth_code",'tempid'=>"MB-2013102300");
    $url = "http://www.mssms.cn:8000/msm/sdk/http/sendsms.jsp";
	$pageContents = HttpClient::quickPost($url, $params);
	echo "=".$pageContents;
