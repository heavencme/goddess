
<!DOCTYPE html>
<html lang="zh">
    <head>
	<link rel="shortcut icon" href="/Favicon.ico" mce_href="../Favicon.ico" type="image/x-icon">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta chaset="uft-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <script src="js/jquery.js" ></script>
        <script src="me/js/me.js" ></script>
        <link href="me/css/style.css" rel="stylesheet" />
        <link href="css/headerstyle.css" rel="stylesheet" />
    </head>
    <body>
        <header>
		<?php
			include_once("header-navi.php");
			session_start();
			include_once( 'weibo/config.php' );
			include_once( 'weibo/weibofun.php' );
			include_once('config.php');
			include_once('zsdb.php');
			$weibo = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
			$uid_json = $weibo->get_uid();
			$wbuid = $uid_json['uid']; //当前登录用户的uid
			$wbprofile=$weibo->show_user_by_id($wbuid);//当前登录uid的基本信息，参考http://open.weibo.com/wiki/2/users/show

		?>	    
	</header>
        <div class="mainwrapper" >
            <div id="leftbar">
                <ul id="bar">
                    <li class="anklist"><a id="ank0" href="#link0">首页图片</a></li>
                    <li class="anklist"><a id="ank1" href="#link1">xxx</a></li>
                    <li class="anklist"><a id="ank2" href="#link2">xxx</a></li>
		    <li class="anklist"><a id="ank3" href="#link3">xxx</a></li>
		    <li class="anklist"><a id="ank4" href="#link4">xxx</a></li>
		    <li class="anklist"><a id="ank5" href="#link5">xxx</a></li>
                </ul>
            </div>
	    <div id="content">
		<h1>吱声控制面板>></h1>
		<form method="post" action="ctrlget.php" enctype="multipart/form-data"><!--enctype="multipart/form-data"-->
		<section id="link0">
                    <div class="sec-header">
                        <h1>
                            <span class="about">首页图片</span>&nbsp;<small>homepage&nbsp;pics</small>
                        </h1>
                    </div>
                    <div class="sec-content">	
                        <table class="content-table">
                                <thead>
                                        <tr>
                                                <td><i class="icon-p"></i> <strong>名称</strong></td>
                                                <td><i class="icon-t"></i> <strong>描述</strong></td>
                                                <td><i class="icon-g"></i> <strong>图片</strong></td>
                                        </tr>
                                </thead>
                                <tbody>
                                        <tr>
						<td><input type="text" name="pic0name" /></td>
						<td><input type="text" name="pic0dscr" /></td>
						<td><input type="file" name="pic0" /></td>
                                        </tr>	                                       
                                        <tr>
						<td><input type="text" name="pic1name" /></td>
						<td><input type="text" name="pic1dscr" /></td>
						<td><input type="file" name="pic1" /></td>
                                        </tr>
                                        <tr>
						<td><input type="text" name="pic2name" /></td>
						<td><input type="text" name="pic2dscr" /></td>
						<td><input type="file" name="pic2"  /></td>
                                        </tr>
                                        <tr>
						<td><input type="text" name="pic3name" /></td>
						<td><input type="text" name="pic3dscr" /></td>
						<td><input type="file" name="pic3" /></td>
                                        </tr>
                                </tbody>
                        </table>
		    </div>
                </section>
		<?php
		    if(isset($wbuid))
			echo" <input type=\"submit\" class=\"subbutton\" value=\"确认提交\"  />";
		    else
			echo"<a href=\"http://zisheng.org\" class=\"subbutton\">登录后这里将显示提交按钮</a>"; 
		?>
		</form>
            </div>
        </div>
    </body>
</html>

