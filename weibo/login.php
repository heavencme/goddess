<?php
session_start();

include_once( 'config.php' );
include_once( 'weibofun.php' );

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>使用微博登陆</title>
</head>

<body>
    <p><a href="<?=$code_url?>"><img src="images/weibo_login.png" title="点击进入授权页面" alt="点击进入授权页面" border="0" /></a></p>

</body>
</html>
