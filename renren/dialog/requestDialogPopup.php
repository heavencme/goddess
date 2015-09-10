<?php
session_start();
require_once '../class/config.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Renren Webcanvas Demo -- Feed</title>
   <script type="text/javascript" src="renren.js"></script>
</head>
<body>
可以参考：http://wiki.dev.renren.com/wiki/Feed_dialog<br>

<script type="text/javascript">
	function sendRequest(){
	var style={
			  top:100,
			  left:100,
			  height:400,
			  width:500
	  };/*用于设置弹层的位置和大小*/
	var params = {
			"accept_url":"http://127.0.0.1/phpsdk/index.php",
			"accept_label":"接受邀请",
			"actiontext":"邀请好友来玩吧"
		};
	var style=null;/*可以设置弹层的位置和尺寸*/
	var uiOpts = {
		url : "request",
		display : "popup", 
	    params : params,
		//style : style,/*设置弹层的位置和尺寸*/
		onSuccess: function(r){},
		onFailure: function(r){} 
	};
	Renren.ui(uiOpts);
}
</script>
  <script type="text/javascript">Renren.init({appId:<?=$config->APPID?>});</script>
  <a onclick="sendRequest()" href="javascript:;">点此邀请好友</a><br>
<br><a  href="../main.php" >返回</a>

</body>
</html>