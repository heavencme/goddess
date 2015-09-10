<?php

session_start();
//renrenlogin

include_once ('ren/config.php');
include_once ('ren/rennclient/RennClient.php');

  $rennClient = new RennClient ( APP_KEY, APP_SECRET );
  $rennClient->setDebug ( DEBUG_MODE );
  
  // 生成state并存入SESSION，以供CALLBACK时验证使用
  $state = uniqid ( 'renren_', true );
  $_SESSION ['renren_state'] = $state;
  // 得认证授权的url
  $rrcode_url = $rennClient->getAuthorizeURL ( CALLBACK_URL, 'code', $state );
if(isset($_SESSION['rraccess_token']))
{
    $rraccess_token=$_SESSION['rraccess_token'];
  //登录信息
  $renn_client = new RennClient ( APP_KEY, APP_SECRET );
  $renn_client->setDebug ( DEBUG_MODE );
  // 获得保存的token
  $renn_client->authWithStoredToken ();
  // 获得用户接口
  $renren_service = $renn_client->getUserService ();
  // 获得当前登录用户
  $renren= $renren_service->info();
  $rruid=$renren[id];
  $rrname=$renren['name'];
  $rrtinyurl=$renren['avatar'][0]['url'];
  // 获得当前用户首页
  $renren_feed = $renn_client->getFeedService();
  $home_feed= $renren_feed->listFeed(30,1);
  
}
?>
<html>
 <head>
	<link rel="stylesheet" type="text/css" href="css/login.css" /> 
 </head>
 <body>
	<div class="logo">
                    <?php
                     //renren
                    if(!isset($rruid))
                    {
                    	echo"  <p class=\"login_button\"><a href=\"$rrcode_url\" target=\"_blank\"><img src=\"images/rr_login.png\" title=\"正在审核尚未开放\" alt=\"正在审核尚未开放\" /></a>(正在审核尚未开放)</p>   
         							";
                    }
                    else
                    {
                		echo"<div class=\"user\" style=\"width:300px;\" >";
                        echo"<div class=\"userlogo\">";
                        echo"<img src=\"$rrtinyurl\" title=\"$rrname\" />";  //?or $res[0][headurl] 
                        echo"</div>";
                        echo"<div class=\"userinfo\">$rrname</div> <div class=\"buttons\" style=\"float:right;\"><a href=\"endsession.php?type=renren\">取消绑定</a></div></div>";
                        echo"</div>";            
                  	}   
                     ?>
        </div>
        
        <div class="buttons" ><a href="https://api.renren.com/v2/feed/list?access_token=<?=$rraccess_token;?>">調用</a></div>
	<div><?php print_r($home_feed); ?></div>
 </body>

</html>