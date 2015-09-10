<?php
 session_start();
 if($_GET['myk']==md5('Im_a_zishenger'))//验证不是机器人
{
    if(isset($_SESSION['token']['access_token']))
        $arr = array ('wbstatus'=>true);//表示微博已经登录,发给login.js(footer.php)
    else
        $arr = array ('wbstatus'=>false);
    if(isset($_SESSION['rrtoken']['access_token']))
        $arr['rrstatus']=true;//表示人人已经登录,发给login.js(footer.php)
    else
        $arr['rrstatus']=false;
    header('Content-Type: application/json');
    print json_encode($arr);
}
?>