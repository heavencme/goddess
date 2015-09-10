<?php

//weibologin
session_start();
include_once( 'weibo/config.php' );
include_once( 'weibo/weibofun.php' );

$oauth = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
$code_url = $oauth->getAuthorizeURL( WB_CALLBACK_URL );//微博授权登录地址callback
//weibo_functions
$weibo = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$uid_json = $weibo->get_uid();
$wbuid = $uid_json['uid']; //当前登录用户的uid
$wbprofile=$weibo->show_user_by_id($wbuid);//当前登录uid的基本信息，参考http://open.weibo.com/wiki/2/users/show
$logout_url=$oauth->getLogoutURL($_SESSION['token']['access_token']);

//renrenlogin
include_once ('renren/config.php');
include_once ('renren/renclient.php');
include_once ('renren/renfun.php');
$rennClient = new renclient( APP_KEY, APP_SECRET );
// 得认证授权的url
$rrcode_url = $rennClient->getAuthorizeURL ( CALLBACK_URL, 'code', $state );

//echo $_SESSION['token']['access_token'];
//renren_functions
if(isset($_SESSION['rrtoken']))
{
    $rraccess_token=$_SESSION['rrtoken']['access_token'];
    // 获得接口
    $renrenapi=new renfun($_SESSION['rrtoken']);
    // 获得当前登录用户
    $renren=$renrenapi->info();
    $rruid=$renren['id'];
    $rrprofile=$renrenapi->getUser($rruid);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>吱声</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="吱声" />
<meta name="description" content="吱声" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0,user-scalable=no"
<link rel="shortcut icon" href="Favicon.ico" mce_href="Favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="css/headerstyle.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type=text/javascript src="js/jquery.js"></script>
<script type=text/javascript src="js/loading.js"></script>
</head>
<body>
<div id="left-wrapper">
    <div id="left-content">
        <div id="left-login">
            <div class="buttons" id="login" ><a>神灯<span id="light1">y</span><span id="light2">y</span></a></div>;   
            <?php include_once('login.php');?>
        </div>
        <div id="friend-list">
            <?php include_once('rightsidebar.php');?>  
        </div>
        <div id="zi-post">
            <?php include_once('zi_pic.php');?>
        </div>
    </div>
</div>
<div id="main-wrapper">
<?php include_once('header-navi.php'); ?>