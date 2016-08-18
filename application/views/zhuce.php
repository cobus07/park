<!-- 用户注册页面 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户注册</title>
	<base href="<?php echo site_url()?>">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
	<div class="main">
		<div class="header">
			<h1>欢迎来到停车场管理系统</h1>
			<a class="admin" href="admin/login">管理员登录</a>
		</div>
		<div class="login">
			<div class="zhuce">
				<form action="welcome/save_user" method="post">
					<h3>新用户注册:</h3>
					<p><input type="text" name="username" placeholder="请输入用户名..."></p>
					<p><input type="password" name="password" placeholder="请输入密码..."></p>
					<p><input type="text" name="car" placeholder="请输入车牌号..."></p>
					<p><input type="text" name="tel" placeholder="请输入联系方式..."></p>
					<p class="godenglu"><a href="welcome/index">您已注册，请点击登录!</a></p>
					<p><input type="submit" value="注册"></p>
				</form>
			</div>
		</div>
	</div>
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/zhuce.js"></script>
</body>
</html>