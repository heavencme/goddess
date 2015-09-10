<?php
header ( 'Content-Type: text/html; charset=UTF-8' );

// 调试模式开关
define ( 'DEBUG_MODE', false );

if (! function_exists ( 'curl_init' )) {
	echo '您的服务器不支持 PHP 的 Curl 模块，请安装或与服务器管理员联系。';
	exit ();
}

// App Key
define ( "APP_KEY", '3e1bf57ecfb04f17b7b700be05e7fab7' );
// App Secret
define ( "APP_SECRET", 'f18022b515f440378ae23e2758561d5f' );
// 应用回调页地址
define ( "CALLBACK_URL", "http://zisheng.org/ren/examples/callback.php" );

if (DEBUG_MODE) {
	error_reporting ( E_ALL );
	ini_set ( 'display_errors', true );
}
