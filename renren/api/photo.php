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
<form method="post" autocomplete="off" action="photoUpload.php" id="renren_bind" >

<div Style="float: left;width: 150px;">
		  <input id="isPublish" name="isPublish" type="checkbox" checked  value="1" /><label for="sharenew" style="position: relative;top:-2px;margin-left: 2px;">上传照片到人人网</label></div><br>
<label style="position: relative;top:-2px;margin-left: 2px;">上传的相册id（默认0，是应用相册） :</label><input type="text" name="aid" value="0" /><br>
<label style="position: relative;top:-2px;margin-left: 2px;">描述 :</label><input type="text" name="description" value="我上传了一张图片" /><br>
<label style="position: relative;top:-2px;margin-left: 2px;">图片url :</label><input type="text" name="img_src" value="http://www.baidu.com/img/baidu_sylogo1.gif" /><br>
<input type="hidden" name="access_token" value=<?echo $access_token;?> />
<input type="submit" name="Submit" value="同步" class="anniu"/><br>
</form>
</body>
</html>
