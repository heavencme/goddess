<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<?php
$access_token=$_SESSION["access_token"];
?>
<form method="post" autocomplete="off" action="feedPublish.php" id="renren_bind" >

<div Style="float: left;width: 150px;">
		  <input id="isPublish" name="isPublish" type="checkbox" checked  value="1" /><label for="sharenew" style="position: relative;top:-2px;margin-left: 2px;">同步到人人</label></div><br>
<label style="position: relative;top:-2px;margin-left: 2px;">name :</label><input type="text" name="name" value="中国地" /><br>
<label style="position: relative;top:-2px;margin-left: 2px;">description :</label><input type="text" name="description" value="你单曲循环了哪首歌？" /><br>
<label style="position: relative;top:-2px;margin-left: 2px;">url :</label><input type="text" name="url" value="http://www.youku.com/show_page/id_z54ff90be0ca511e097c0.html" /><br>
<label style="position: relative;top:-2px;margin-left: 2px;">image :</label><input type="text" name="image" value="http://img1.c3.letv.com/ptv/uploads/390/144/n189791311307066.jpg" /><br>
<label style="position: relative;top:-2px;margin-left: 2px;">action_name :</label><input type="text" name="action_name" value="通过优酷发布" /><br>
<label style="position: relative;top:-2px;margin-left: 2px;">action_link :</label><input type="text" name="action_link" value="http://www.youku.com/" /><br>
<label style="position: relative;top:-2px;margin-left: 2px;">message  :</label><input type="text" name="message" value="这个视频不错，大家都来看吧" /><br>
<input type="hidden" name="access_token" value=<?echo $access_token;?> />
<input type="submit" name="Submit" value="同步" class="anniu"/><br>
</form>
</body>
</html>
