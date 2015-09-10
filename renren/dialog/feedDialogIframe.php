<?php
session_start();
require_once '../config.inc.php';
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
新鲜事标题（上限30）：<input type="text" value="新鲜事测试，这里是标题" id="title"/><br/>
新鲜事主题内容（上限120）：<input type="text" value="现在我正在测试人人网新鲜事功能，不要理我" id="description"/><br/>
新鲜事图片链接：<input type="text" value="http://fmn.rrimg.com/fmn060/20111228/0020/p_head_1GGB_6ea1000021b3121b.jpg" id="image" /><br/>
新鲜事标题及图片的链接：<input type="text" value="http://127.0.0.1/phpsdk/index.php" id="url" /><br/>
默认评论：<input type="text" value="这个网站不错啊~" id="message" /><br/>
action_name :<input type="text" id="action_name" value="通过优酷发布" /><br>
action_link :<input type="text" id="action_link" value="http://www.youku.com/" /><br>
<!--点击确定或取消后跳转的url：<input type="text" value="http://127.0.0.1" id="redirect_uri" /><br/>-->

<script type="text/javascript">
	function sendFeed() {
		var title=document.getElementById("title").value;
		var description=document.getElementById("description").value;
		var image=document.getElementById("image").value;
		var url=document.getElementById("url").value;
		var message=document.getElementById("message").value;
		var action_name=document.getElementById("action_name").value;
		var action_link=document.getElementById("action_link").value;
		//var redirect_uri=document.getElementById("redirect_uri").value;
		var style={
			  top:100,
			  left:100,
			  height:400,
			  width:500
	  };/*用于设置弹层的位置和大小*/
		var uiOpts = {
		  url : "feed",
		  display : "iframe",
		  method : "post",
		  params : {
		    "url":url,
		    "name":title,
		    "description":description,
		    "image":image,
			"message":message,
			"action_name":action_name,
			"action_link":action_link,
			"access_token":'<?=$_SESSION["access_token"]?>'//如果不传此参数的话，display只能改成popup的形式，弹出页面而不是弹层
		  },
		  //style : style,
		  onSuccess: function(r){/*alert("success!");*/},
		  onFailure: function(r){/*alert("fail");document.getElementById("ttt").value="111";*/} 
	  };
	  Renren.ui(uiOpts);
	}
</script>
   <script type="text/javascript">Renren.init({appId:<?=$config->APPID?>});</script>
  <a onclick="sendFeed()" href="javascript:;">点此发送新鲜事</a><br>
<br><a  href="../main.php" >返回</a>

</body>
</html>