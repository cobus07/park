<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>车费管理</title>
	<base href="<?php echo site_url();?>">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/chefeibianji.css">
</head>
<body>
	<form action="admin/chefeibianji" method="post">
		<p>
			<label for="cartype">车辆类型:</label>
			<input id="cartype" type="text" name="cartype" placeholder="请输入车辆类型...">
		</p>
		<p>
			<label for="cardtype">是否为会员:</label>
			<input type="radio" name="cardtype" id="cardtype">
		</p>
		<p>
			<label for="money">每小时价格:</label>
			<input id="money" type="text" name="money" placeholder="请输入车辆每小时价格...">
		</p>
		<p>
			<input type="submit" value="提交">
		</p>
	</form>
</body>
</html>