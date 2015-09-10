<?php
session_start();
if($_GET['myk']==md5('Im_a_zishenger'))//验证不是机器人
{
    $arr = array ('accs'=>$_SESSION['token']['access_token']);//将token值取出来发给ajax.js(wall.php)
    header('Content-Type: application/json');
    print json_encode($arr);
}
?>