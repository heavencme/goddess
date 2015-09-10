<?php
	/**
	 *人人的处理
	 *
	 *
	 *
	 *
	 **/
	class renclient {
		
		protected $token=array();//若为priva 则子类中无法通过__construct()对其赋值，则与token相关函数无法使用
		private $appkey;
		private $appsecret;
		const authURL='https://graph.renren.com/oauth/authorize';
		const tokenURL='http://graph.renren.com/oauth/token';
		const USERAGENT = 'Renn API2.0 SDK PHP v0.1';
		/**
		* API host
		*/
		const API_HOST = 'api.renren.com';
		/**
		 * Set timeout default.
		 */
		const TIMEOUT = 60;
		/**
		 * Set connect timeout.
		 */
		const CONNECTTIMEOUT = 30;
		
		function __construct($appkey,$appsecret)
		{
			$this->appkey=$appkey;
			$this->appsecret=$appsecret;
		}
		
		
		/**
		 *make a http request
		 *
		 **/
		private function http($url,$method,$postfields=null,$headers=array())
		{
			$this->httpInfo = array ();
			$ci = curl_init ();
			/* Curl settings */
			curl_setopt ( $ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0 );
			curl_setopt ( $ci, CURLOPT_USERAGENT, self::USERAGENT );
			curl_setopt ( $ci, CURLOPT_CONNECTTIMEOUT, self::CONNECTTIMEOUT );
			curl_setopt ( $ci, CURLOPT_TIMEOUT, self::TIMEOUT );
			curl_setopt ( $ci, CURLOPT_RETURNTRANSFER, TRUE );
			curl_setopt ( $ci, CURLOPT_ENCODING, "" );
			curl_setopt ( $ci, CURLOPT_SSL_VERIFYPEER, FALSE );
			curl_setopt ( $ci, CURLOPT_SSL_VERIFYHOST, 2 );
			curl_setopt ( $ci, CURLOPT_HEADER, FALSE );
			
			// 方法
			switch ($method)
			{
				case 'POST' :
					curl_setopt ( $ci, CURLOPT_POST, TRUE );
					if (! empty ( $postfields ))
					{
						curl_setopt ( $ci, CURLOPT_POSTFIELDS, $postfields );
					}
					break;
				case 'DELETE' :
					curl_setopt ( $ci, CURLOPT_CUSTOMREQUEST, 'DELETE' );
					if (! empty ( $postfields ))
					{
						$url = "{$url}?{$postfields}";
					}
			}
			
			curl_setopt ( $ci, CURLOPT_URL, $url );
			curl_setopt ( $ci, CURLOPT_HTTPHEADER, $headers );
			curl_setopt ( $ci, CURLINFO_HEADER_OUT, TRUE );
			
			$response = curl_exec ( $ci );
			$this->httpCode = curl_getinfo ( $ci, CURLINFO_HTTP_CODE );
			$this->httpInfo = array_merge ( $this->httpInfo, curl_getinfo ( $ci ) );
			curl_close ( $ci );
			return $response;
			
		}
		
		
		/**
		* 根据token类型来获得认证头
		*/
	       private function getAuthorizationHeader($schema, $pathAndQuery, $method)
	       {	
		       // 签名相关参数
		       $timestamp = intval ( time () / 1000 ); // 时间戳，以秒为单位，以客户端的时间为准
		       $nonce = $this->generateRandomString ( 8 ); // 随机码，随即字符串，由客户端生成
		       $ext = ""; // 其他信息，客户端自定义
		       $host = self::API_HOST; // 目标服务器的主机 TODO 常量
		       $port = $schema == "https" ? 443 : 80;
		       
		       // 签名的原始字符串
		       $signatureBaseString = $timestamp . "\n" . $nonce . "\n" . $method . "\n" . $pathAndQuery . "\n" . $host . "\n" . $port . "\n" . $ext . "\n";
		       
		       // 签名
		       $signature = $this->generateSignature($signatureBaseString, $this->token['mac_key'] );
		       return sprintf("Authorization:MAC id=\"%s\",ts=\"%s\",nonce=\"%s\",mac=\"%s\"", $this->token['access_token'], $timestamp, $nonce, $signature );
	       }
	       
	       /**
	        *
	        *
	        *
	        **/
	       private function generateSignature($signatureBaseString, $signatureSecret)
	       {
			return base64_encode(hash_hmac('sha1', $signatureBaseString, $signatureSecret, true) );
	       }
	       
	       
	       /**
		* 生成随机字符串
		*
		* @param integer $length        	
		*/
	       private function generateRandomString($length = 8)
	       {
		       // 密码字符集，可任意添加你需要的字符
		       $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		       $random_str = "";
		       for($i = 0; $i < $length; $i ++) {
			       // 这里提供两种字符获取方式
			       // 第一种是使用 substr 截取$chars中的任意一位字符；
			       // $random_str .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
			       // 第二种是取字符数组 $chars 的任意元素
			       $random_str .= $chars [mt_rand ( 0, strlen ( $chars ) - 1 )];
		       }
		       return $random_str;
	       }
		
		
		
		/*
		 *获取登录地址
		 */
		function getAuthorizeURL($redirectUrl, $responseType='code')
		{
			$params = array ();
			$params ['client_id'] = $this->appkey;
			$params ['redirect_uri'] = $redirectUrl;
			$params ['response_type'] = $responseType;
			$params ['scope']='status_update read_user_feed publish_feed read_user_share';
			return self::authURL."?".http_build_query ($params);
		}
		
		/*
		 *获取access_token
		 *
		 **/
		function getToken($grantType,$code,$callbackurl)
		{
			$params=array();
			$params['grant_type']='authorization_code';
			$params['client_id']=$this->appkey;
			$params['client_secret']=$this->appsecret;
			$params['redirect_uri']=$callbackurl;
			$params['code']=$code;
			$params['token_type']='mac';//获取mac token, never expires
			// 获得token
			$response = $this->http(self::tokenURL,'POST',http_build_query($params, null,'&') );
			$tokenarray =json_decode($response,true);
			//print_r("response:".$response."------");
			//print_r($token);
			
			$this->token['access_token']=$tokenarray['access_token'];
			$this->token['mac_key']=$tokenarray['mac_key'];
			$tokenout=$this->token;
			return $tokenout;
		}
		
		/**
		 *
		 *执行查询（api2.0中的接口）
		 **/
		
		function execute($path, $httpMethod, $queryParams)
		{
			$schema = "http";
			
			// path & query
			$url=$schema . "://" . self::API_HOST . $path;
			$pathAndQuery=$path;
			if (! empty ( $queryParams ))
			{ // 注意：在get请求的url中，有参数有'?'，无参数无'?'
				$query = http_build_query ( $queryParams );
				if (!empty ($query)) {
					$url = $url . '?' . $query;
					$pathAndQuery = $path . '?' . $query;
				}
			}
			
			// headers
			$headers = array ();
			
			// authorization header
			if ($this->token['access_token']) {
				$headers[]= $this->getAuthorizationHeader( $schema, $pathAndQuery, $httpMethod );
			}
			
			$headers [] = 'Content-type: application/x-www-form-urlencoded';
			$headers [] = 'Content-length: 0';
			$response = $this->http ( $url, $httpMethod, null, $headers );//只是用户mac方式的空头
			
			$result = json_decode ( $response, true );
			if (isset ( $result ['error'] ) && $result ['error'])
			{
				//print_r($result);
				print_r("人人网未响应，请刷新");
				return;
			}
			return $result ['response'];
		}
		
		
		
		
		
		
		
		
	}
	
	
?>
