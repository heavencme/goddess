<?php
session_start ();

include_once ('renren/config.php');
include_once ('renren/renclient.php');

$rennClient = new renclient(APP_KEY, APP_SECRET);


// 得认证授权的url
$code_url = $rennClient->getAuthorizeURL(CALLBACK_URL,'code');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>人人 PHP SDK Demo</title>
</head>

<body>
	<!-- 打开认证授权的页面 -->
	<p>
		<a href="<?=$code_url?>"> 点击登录</a>
	</p>
	<hr />
</body>
</html>
