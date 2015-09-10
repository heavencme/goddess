<!DOCTYPE html>
<html lang="zh">
    <head>
	<title>咱们班旅游统计</title>
	<meta charset="utf-8">
	<meta name="keywords" content="女神" />
	<meta name="description" content="女神" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <link rel="stylesheet" href="css/jquery-ui.css">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui.js"></script>
        <script src="js/me.js" ></script>
        <link href="css/style.css" rel="stylesheet" />
    </head>
    <body>
	<div class="mainwrapper" >
            <div id="leftbar">
                <ul id="bar">
                    <li class="anklist"><a id="ank0" href="#link0">你谁啊</a></li>
                    <li class="anklist"><a id="ank1" href="#link1">啥时去</a></li>
                    <li class="anklist"><a id="ank2" href="#link2">去几天</a></li>
		    <li class="anklist"><a id="ank3" href="#link3">去哪儿</a></li>
		    <li class="anklist"><a id="ank4" href="#link4">确定啦</a></li>
                </ul>
            </div>
            <div id="content">
                <section id="link0">
		    <div class="sec-header">
                        <h1>谁啊？</h1>
                    </div>
		    <div id="sec-content-1">
			<span>我是<input type="text" id="myname" placeholder="名字" required aria-required="true" /></span>
		    </div>
		</section>
		
		<section id="link1">
		    <div class="sec-header">
                        <h1>哪天出发好呢？</h1>
                    </div>
		    <div id="sec-content">
			<span>日期<input type="text" name="start-day" id="date-picker" placeholder="点击" required aria-required="true" /></span>
		    </div>
		</section>
		
		<section id="link2">
		    <div class="sec-header">
                        <h1>点选你空余的时间</h1>
                    </div>
		    <div id="sec-content">
			<div id="calendar1" class="my-calendar">
			    <div class="calendar-title">
				<span class="calendar-month">April&nbsp;2014</span>
			    </div>
			    <table class="calendar-content">
				<thead>
				    <tr>
					<th><span title="Monday">Mon</span></th>
					<th><span title="Tuesday">Tue</span></th>
					<th><span title="Wednesday">Wed</span></th>
					<th><span title="Thursday">Thu</span></th>
					<th><span title="Friday">Fri</span></th>
					<th><span title="Saturday">Sat</span></th>
					<th><span title="Sunday">Sun</span></th>
				    </tr>
				</thead>
				<tbody id="cld-body" >
				    
				</tbody>
			    </table>
			</div>
		    </div>
		</section>
		
		<section id="link3">
		    <div class="sec-header">
                        <h1>去哪儿</h1>
                    </div>
		    <div id="sec-content">
			<span>只能选一哦</span><br />
			<input type="radio" name="destination" id="qinghai_lake" />青海湖<br />
			<input type="radio" name="destination" id="zhoushan_isle" />舟山群岛<br />
		    </div>
		</section>
		<section id="link4">
		    <div class="sec-header">
                        <h1>确认啦</h1>
                    </div>
		    <div id="sec-content">
			<input id="subbutton" type="submit" class="subbutton" value="确认"  />
		    </div>
		</section>
    </body>
