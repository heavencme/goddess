<?php

session_start();
include_once( 'weibo/config.php' );
include_once( 'weibo/weibofun.php' );
$weibo = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$uid_json = $weibo->get_uid();
$wbuid = $uid_json['uid']; //当前登录用户的uid
$wbprofile=$weibo->show_user_by_id($wbuid);//当前登录uid的基本信息，参考http://open.weibo.com/wiki/2/users/show

ignore_user_abort(); // 函数设置与客户机断开是否会终止脚本的执行
set_time_limit(0); // 来设置一个脚本的执行时间为无限长
$interval=80;
$file = fopen("words2.ini","r");
if(isset($wbuid))
{
    
    while(!feof($file))
    {
	if(is_file("test2.ini"))
	    $test=parse_ini_file("test2.ini");
	if(empty($test)||$test['allowance']!="ok")
	    break;
        $w=fgets($file,200);
        if( isset($w)) {
	$weibo->update(fgets($file));	//发送微博
        sleep($interval); // 函数延迟代码执行若干秒
    }
    
}
fclose($file);
}
?>