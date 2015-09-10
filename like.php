<?php
session_start();
include_once( 'weibo/config.php' );
include_once( 'weibo/weibofun.php' );
$oauth = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
$weibo = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$uid_json = $weibo->get_uid();
$wbuid = $uid_json['uid']; //当前登录用户的uid
include_once('config.php');

include_once('zsdb.php');
$db=new zsdb($dbuser,$dbpassword,$dbname,$dbhost);
if($db->ready)
{
    if(isset($wbuid)&&$db->exist_uid($wbuid))
    {
        $id=$db->wbuid2id($wbuid);
        $db->like($id,$_GET['likeuid']);
    }
}
?>