<!-- 用户登录页面 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>停车场管理系统</title>
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
			<div class="denglu">
				<form action="welcome/check_login" method="post">
					<h3>用户登录:</h3>
					<p><input type="text" name="username" placeholder="请输入用户名..."></p>
					<p><input type="password" name="password" placeholder="请输入密码..."></p>
					<p><input type="submit" value="登录"></p>
				</form>
			</div>
		</div>
	</div>
</body>
</html>