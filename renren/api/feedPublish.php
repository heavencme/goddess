<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<?php
require_once '../class/RenrenRestApiService.class.php';
echo 'access_token:'.$_POST["access_token"].'<br>';
echo 'name:'.$_POST["name"].'<br>';
echo 'description:'.$_POST["description"].'<br>';
echo 'url:'.$_POST["url"].'<br>';
echo 'image:'.$_POST["image"].'<br>';
echo 'action_name:'.$_POST["action_name"].'<br>';
echo 'action_link:'.$_POST["action_link"].'<br>';
echo 'message:'.$_POST["message"].'<br>';
echo 'isPublish:'.$_POST["isPublish"].'<br>';
echo '<hr>';
echo '华丽的分割线';
echo '<hr>';

$access_token=$_POST["access_token"];
$name=$_POST["name"];
$description=$_POST["description"];
$url=$_POST["url"];
$image=$_POST["image"];
$action_name=$_POST["action_name"];
$action_link=$_POST["action_link"];
$message=$_POST["message"];
$isPublish=$_POST["isPublish"];
$restApi = new RenrenRestApiService;
if($isPublish==1)
{

$params = array('name'=>$name,'description'=>$description,'url'=>$url,'image'=>$image,'action_name'=>$action_name,'action_link'=>$action_link,'message'=>$message,'access_token'=>$access_token);
//print_r($params);
$res = $restApi->rr_post_curl('feed.publishFeed', $params);//curl函数发送请求

echo 'post_id:'.$res["post_id"];
}
?>
<br><a  href="../main.php" >返回</a>
</body>
</html>