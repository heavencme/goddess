<?php
    if($_REQUEST['type']=='sent')
    {
        if(isset($_REQUEST['key'])&&isset($_REQUEST['val']))
            {
                $key=$_REQUEST['key'];
                $val=$_REQUEST['val'];
                if($_REQUEST['exp']=='longtime')
                    setcookie($key,$val,time()+3600*24*180);//有效期180天
                else
                    setcookie($key,$val,time()+3600);//默认有效期1个小时
            }
    }
    elseif($_REQUEST['type']=='receive')
    {
        header('Content-Type: application/json');
        print json_encode($_COOKIE);
    }
?>