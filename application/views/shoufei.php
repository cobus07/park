<!-- 停车场收费标准 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>收费标准</title>
	<base href="<?php echo site_url()?>">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/shoufei.css">
</head>
<body>
	<div id="shoufei">
		<h3>欢迎来到XX停车场</h3>
		<img src="imgs/article.jpg" alt="收费标准">
		<div class="biaozhun">
			<h4>停车场帮助如下：</h4>
			<ul>
				<!-- <li>非会员</li> -->
				<li>小型车：<?php echo $result[0]->unitmoney?>元/辆、小时</li>
				<li>大型车：<?php echo $result[1]->unitmoney?>元/辆、小时</li>
				<!-- <li>会员</li>
				<li>小型车：<?php echo $result[2]->unitmoney?>元/辆、小时</li>
				<li>大型车：<?php echo $result[3]->unitmoney?>元/辆、小时</li> -->
				<li>注：1.停车不超过15分钟的免收停车费</li>
				<li>&nbsp;&nbsp;2.停车不足1小时的按1小时收费</li>
				<li>&nbsp;&nbsp;3.停车时间6至24小时的，按24小时收费</li>
			</ul>
			<p></p>
		</div>
		<footer id="footer">
			<ul>
				<li><a href="">关于我们</a></li>
				<li><a href="">联系我们</a></li>
			</ul>
			<p>黑ICP备11029623号-2 © 2016 版权所有</p>
		</footer>
	</div>
</body>
</html>