<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <script type=text/javascript src="js/effects.js"></script>
</head>
<body>
    <div>
    <?php
    session_start();//即时删除也需要先初始化 
     switch($_GET['type'])
     {
        case "weibo":
            unset($_SESSION['token']); //weibo信息存在Array ( [token] => Array ( [access_token] => 2.00_8bGjBhilbDDdc0625a1f6b6967D [remind_in] => 157679999 [expires_in] => 157679999 [uid] => 1582641841 ) )
            //session_destroy();//删除session
            echo "已解除微博绑定"; ?>
            
        <div id="jump"></div>
        <script language="javascript"> Load("index.php","秒后自动返回"); </script> <!--解绑成共返回登录页面-->
    
    <?php        
            break;
        
        case "renren":
            unset($_SESSION['rrtoken']);
            echo "已解除人人绑定"; ?>
        <div id="jump"></div>
        <script language="javascript"> Load("index.php","秒后自动返回"); </script> <!--解绑成共返回登录页面-->    
    <?php
            break;
        default:
            break;
     }
    ?>
    </div>
</body>