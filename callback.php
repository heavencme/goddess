<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>微博直接登陆吱声</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="keywords" content="" />
<meta name="description" content="用微博登陆吱声" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type=text/javascript src="js/jquery.js"></script>
<script type=text/javascript src="js/effects.js"></script>
<link rel="shortcut icon" href="/favicon.ico" />
</head>
<body>
<?php
session_start();
include_once('config.php');
include_once('zsdb.php');
include_once( 'weibo/config.php' );
include_once( 'weibo/weibofun.php' );
$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );



if (isset($_REQUEST['code'])) {
	$keys = array();
	$keys['code'] = $_REQUEST['code'];
	$keys['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token = $o->getAccessToken( 'code', $keys ) ;
	} catch (OAuthException $e) {
	}
}

if ($token) {
	$_SESSION['token'] = $token;
	//更新数据库中access_token
	$db=new zsdb($dbuser,$dbpassword,$dbname,$dbhost);
	if($db->ready)
	{
		if($db->exist_uid($wbuid))//用户uid不存在
		{
			$db->update_token('weibo',$wbuid,$token['access_token']);
		}
		$db->db_discon();
	}
	
?>
授权完成,<div style="width: 300px">
		<div id="jump" style="float: left;"></div>
		<div class="buttons" style="float: left;margin-bottom: 1px"> <a href="index.php">吱声</a> </div>
		<script language="javascript"> Load("index.php","秒后自动返回"); </script> <!--授权成功则回主页-->
	</div>
<?php
} else {
?>
抱歉，是不是忘记密码了？<div id="jump"></div>
<div class="buttons"> <a href="index.php">吱声</a> </div>
	<script language="javascript"> Load("<?=$code_url?>","秒后再试一次</br>或者返回"); </script> <!--授权不成功则重新进入授权页面-->
<?php
}
?>

</body>
</html>
