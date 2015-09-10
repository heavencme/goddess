<?php
session_start();
include_once( 'weibo/config.php' );
include_once( 'weibo/weibofun.php' );
include_once('config.php');
include_once('zsdb.php');
$weibo = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$uid_json = $weibo->get_uid();
$wbuid = $uid_json['uid']; //当前登录用户的uid
$wbprofile=$weibo->show_user_by_id($wbuid);//当前登录uid的基本信息，参考http://open.weibo.com/wiki/2/users/show
$sid=$_GET['sid'];
setcookie("sid", $sid, time()+3600); //刚刚加载页面，第一次设置
?>
<head>
<link rel="stylesheet" type="text/css" href="css/zi.css" />
<style>
html{
	background: #fff;
}
</style>

</head>
<body>
	<div class="zi">
		<form action="" >
			
			<textarea name="text" style="width: 300px;height: 140px;">转发微博:)</textarea>
			<input class="icons" type="submit" value="I" style="float: right;width:34px;height: 28px;margin-bottom:1px;" />
			<input class="icons" type="reset" value="l" style="float: right;width:34px;height: 28px;margin-bottom:1px;" />
			<?php
			if( isset($_REQUEST['text'])) {
				$ret = $weibo->repost($_COOKIE['sid'],$_REQUEST['text'],3); //发送微博，不是刚刚加载页面，第二次了
				if ( isset($ret['error_code']) && $ret['error_code'] > 0 ) {
					echo "<p id=\"bad\">发送失败，错误：{$ret['error_code']}:{$ret['error']}</p>";
				} else {
					echo "<p id=\"good\">j发送成功</p>";
					$db=new zsdb($dbuser,$dbpassword,$dbname,$dbhost);
					if($db->ready)
					{     
					    if(isset($wbuid)&&$db->exist_uid($wbuid)==true)//用户uid已登录且数据库中有其记录
					    {
						$id=$db->wbuid2id($wbuid);
						$db->addbook($_REQUEST['text'],$id,$wbprofile['screen_name']);
					    }
					}
				}
			}
			
			?>
		</form>
	</div>

</body>
