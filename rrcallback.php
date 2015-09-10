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

<?php
session_start ();
include_once('config.php');
include_once('zsdb.php');
include_once ('renren/config.php');
include_once ('renren/renclient.php');
include_once ('renren/renfun.php');

$rennClient = new renclient(APP_KEY,APP_SECRET);

// 处理code -- 根据code来获得token
if (isset ( $_REQUEST ['code'] ))
{
	// 获得code
	$codeFrom=$_REQUEST['code'];
	// 根据code来获得token
	$token=$rennClient->getToken('code',$codeFrom,CALLBACK_URL);
	
		
	//print_r($token);
	//$renren=new renfun($token);
	//print_r($renren->info());
	//$rennClient->test();
	//print_r($rennClient->info());
	
}
?>

<body>
<?php
	if ($token)
	{
		$_SESSION['rrtoken']=$token;
		
		// 获得接口
		$renrenapi=new renfun($_SESSION['rrtoken']);
		// 获得当前登录用户
		$renren=$renrenapi->info();
		$rruid=$renren['id'];
		
		//更新数据库中access_token
		$db=new zsdb($dbuser,$dbpassword,$dbname,$dbhost);
		if($db->ready)
		{
			if($db->exist_uid_rr($rruid))//用户uid不存在
			{
				$db->update_token('renren',$rruid,$token['access_token']);
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

// 得认证授权的url
$code_url = $rennClient->getAuthorizeURL ( CALLBACK_URL, 'code', $state );



?>
抱歉，是不是忘记密码了？<div id="jump"></div>
<div class="buttons"> <a href="index.php">吱声</a> </div>
<script language="javascript"> Load("<?=$code_url?>","秒后再试一次</br>或者返回"); </script> <!--授权不成功则重新进入授权页面-->	
<?php
}
?>

</body>
</html>


