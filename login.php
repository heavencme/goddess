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
//echo $_SESSION['token']['access_token'];


//renrenlogin

include_once ('renren/config.php');
include_once ('renren/renclient.php');
include_once ('renren/renfun.php');
$rennClient = new renclient( APP_KEY, APP_SECRET );
// 得认证授权的url
$rrcode_url = $rennClient->getAuthorizeURL ( CALLBACK_URL, 'code', $state );
if(isset($_SESSION['rrtoken']))
{
  $rraccess_token=$_SESSION['rrtoken']['access_token'];
  //初始化renfun.php
  $renrenapi=new renfun($_SESSION['rrtoken']);
  // 获得当前登录用户
  $renren=$renrenapi->info();
  $rruid=$renren['id'];
  $rrname=$renren['name'];
  $rrtinyurl=$renren['avatar'][0]['url'];
}
?>
	<div class="login-btn">
                    <?php
                    $cut_descp=mb_strcut($wbprofile['description'],0,99,'utf-8');//截取utf-8字符串长度
                  
                    if(mb_strlen($wbprofile['description'],'utf-8')>=99)
                        $str_too_long="...";
                    else
                        $str_too_long=" ";
                    //weibo
                    if(!isset($wbuid))
                      echo"  <p class=\"login_button\" id=\"wb-btn\" style=\"margin-left:72px\"><a  title=\"登录微博\" href=\"$code_url\">I</a></p> ";
                    else
                    {
                        echo"<div class=\"user\" style=\"width:300px;\">";
                        echo"<div class=\"userlogo\">";
                        echo"<img src=\"$wbprofile[profile_image_url]\" title=\"$wbprofile[screen_name]\" />";
                        echo"</div>";
                        echo"<div class=\"userinfo\">$cut_descp.$str_too_long</div> <div class=\"buttons\"><a href=\"endsession.php?type=weibo\">取消绑定</a></div> </div>";
			
                    }
                     //renren
                    if(!isset($rruid))
                    {
                    	echo"  <p class=\"login_button\" id=\"rr-btn\"><a title=\"登录人人\" href=\"$rrcode_url\">H</a></p>   
         							";
                    }
                    else
                    {
                	echo"<div class=\"user\" style=\"width:300px;\" >";
                        echo"<div class=\"userlogo\">";
                        echo"<img src=\"$rrtinyurl\" title=\"$rrname\" />";  //?or $res[0][headurl] 
                        echo"</div>";
                        echo"<div class=\"userinfo\">$rrname</div> <div class=\"buttons\" ><a href=\"endsession.php?type=renren\">取消绑定</a></div></div>";
                        echo"</div>";            
                  	}
                     ?>
        </div>