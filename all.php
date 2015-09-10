<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh" ng-app>
<head>
	<title>吱声--朋友墙</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="吱声" />
	<meta name="description" content="吱声" />
	<link rel="shortcut icon" href="Favicon.ico" mce_href="Favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/headerstyle.css" />
	<link rel="stylesheet" type="text/css" href="css/all.css" />
	<script src="./js/jquery.js"></script>
	<script src="./js/tipboard.js"></script>
	<script src="./angular/lib/angular/angular.js"></script>
	<script src="./angular/js/controllers.js"></script>
</head>
<body ng-controller="homeList">
	<?php include_once('header-navi.php'); ?>
	<script type=text/javascript src="js/jquery.js"></script>
	<div class="search">
	        搜一下: <input ng-model="query">
	        <br />
		排一下:
	        <select ng-model="orderProp">
			<option>默认排序</option>
			<option value="speak_time">更新日期</option>
			<option value="user_name">TA的名字</option>
	        </select>
	
	</div>
	<div id="social_list">
		<div id="waterfall" class="waterfall">
			<div class="dym-dl">
				<div class="dym" ng-repeat="item in home['renren0'] | filter:query | orderBy:orderProp">
					<div class="speaker">
					    <img src="{{item.user_image}}" />
					</div>
					<div class="nickname">
						<a href="{{item.user_url}}" target="_blank">{{item.user_name}}</a>
					</div>
					<div class="words">
						{{item.words_text}} &nbsp;&nbsp;
							<a href="{{item.retweet.user_url}}" style="font-weight:bold" target="_blank">{{item.retweet.user_name}}</a>
							{{item.retweet.words_text}}
							<a href="{{item.retweet.words_pic_original}}" target="_blank">
								<img src="{{item.retweet.words_pic_thumb}}" />
							</a>
							<br />
						<a href="{{item.words_pic_original}}" target="_blank">
							<img src="{{item.words_pic_thumb}}"  />
						</a>
					</div>
					<div class="speak_time">{{item.speak_time}}&nbsp;&nbsp;{{item.location}}</div>
				</div>
			</div>
			
			<div class="dym-dl">
				<div class="dym" ng-repeat="item in home['renren1'] | filter:query | orderBy:orderProp">
					<div class="speaker">
					    <img src="{{item.user_image}}" />
					</div>
					<div class="nickname">
						<a href="{{item.user_url}}" target="_blank">{{item.user_name}}</a>
					</div>
					<div class="words">
						{{item.words_text}} &nbsp;&nbsp;
							<a href="{{item.retweet.user_url}}" style="font-weight:bold" target="_blank">{{item.retweet.user_name}}</a>
							{{item.retweet.words_text}}
							<a href="{{item.retweet.words_pic_original}}" target="_blank">
								<img src="{{item.retweet.words_pic_thumb}}" />
							</a>
							<br />
						<a href="{{item.words_pic_original}}" target="_blank">
							<img src="{{item.words_pic_thumb}}"  />
						</a>
					</div>
					<div class="speak_time">{{item.speak_time}}&nbsp;&nbsp;{{item.location}}</div>
				</div>
			</div>
			
			<div class="dym-dl">
				<div class="dym" ng-repeat="item in home['weibo0'] | filter:query | orderBy:orderProp">
					<div class="speaker">
					    <img src="{{item.user_image}}" />
					</div>
					<div class="nickname">
						<a href="{{item.user_url}}" target="_blank">{{item.user_name}}</a>
					</div>
					<div class="words">
						{{item.words_text}} &nbsp;&nbsp;
							<a href="{{item.retweet.user_url}}" style="font-weight:bold" target="_blank">{{item.retweet.user_name}}</a>
							{{item.retweet.words_text}}
							<a href="{{item.retweet.words_pic_original}}" target="_blank">
								<img src="{{item.retweet.words_pic_thumb}}" />
							</a>
							<br />
						<a href="{{item.words_pic_original}}" target="_blank">
							<img src="{{item.words_pic_thumb}}" />
						</a>
					</div>
					<div class="speak_time">{{item.speak_time}}&nbsp;&nbsp;{{item.location}}</div>
				</div>
			</div>
			
			<div class="dym-dl">
				<div class="dym" ng-repeat="item in home['weibo1'] | filter:query | orderBy:orderProp">
					<div class="speaker">
					    <img src="{{item.user_image}}" />
					</div>
					<div class="nickname">
						<a href="{{item.user_url}}" target="_blank">{{item.user_name}}</a>
					</div>
					<div class="words">
						{{item.words_text}} &nbsp;&nbsp;
							<a href="{{item.retweet.user_url}}" style="font-weight:bold" target="_blank">{{item.retweet.user_name}}</a>
							{{item.retweet.words_text}}
							<a href="{{item.retweet.words_pic_original}}" target="_blank">
								<img src="{{item.retweet.words_pic_thumb}}" />
							</a>
							<br />
						<a href="{{item.words_pic_original}}" target="_blank">
							<img src="{{item.words_pic_thumb}}" />
						</a>
					</div>
					<div class="speak_time">{{item.speak_time}}&nbsp;&nbsp;{{item.location}}</div>
				</div>
			</div>
			
			
			
		</div>
	</div>
</body>
</html>