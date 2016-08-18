<!-- 管理员 管理 用户编辑 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户管理编辑</title>
	<base href="<?php echo site_url();?>">
	<link rel="stylesheet" href="css/main.css">
	<style>
		header{
			width: 1200px;
			height: 70px;
			text-align: center;
			line-height: 70px;
			letter-spacing: 5px;
			font-size: 30px;
			margin: 0 auto;
			background: #333;
			color: #fff;
		}
		#container{
			width: 360px;
			height: 470px;
			border: 2px solid #333;
			box-shadow: 3px 3px 3px #eee;
			border-radius: 10px;
			margin: 50px auto;
		}
		h3{
			height: 40px;
			line-height: 40px;
			text-align: center;
		}
		p{
			width: 270px;
			margin: 20px auto;
		}
		input{
			outline: none;
			width: 270px;
			height: 30px;
			border-radius: 5px;
			text-indent: 5px;
		}
		input[type='submit']{
			cursor: pointer;
		}
		/*footer*/
		#footer{
			background-color: #333;
			clear: both;
			width: 1200px;
			height: 100px;
			margin: 0 auto;
		}
		#footer ul{
			width: 400px;
			height: 50px;
			margin: 0 auto;
		}
		#footer li{
			float: left;
			width: 200px;
			height: 50px;
			line-height: 50px;
			text-align: center;
		}
		#footer a{
			color: #fff;
		}
		#footer p{
			clear: both;
			width: 100%;
			height: 30px;
			line-height: 30px;
			text-align: center;
			color: #fff;
		}
	</style>
</head>
<body>
	<header>
		XX停车场管理系统
	</header>
	<div id="container">
		<h3>用户管理编辑</h3>
		<form action="admin/bianjiuser" method="post">
			<input type="text" hidden="hidden" name="userid" value="<?php echo $user->user_id?>">
			<p><label for="">用户名：</label><input type="text" name="username" placeholder="<?php echo $user->username?>"></p>
			<P><label for="">密码：</label><input type="text" name="password" placeholder="<?php echo $user->password?>"></p>
			<p><label for="">车牌号：</label><input type="text" name="carno" placeholder="<?php echo $user->carno?>"></p>
			<p><label for="">电话号：</label><input type="text" name="tel" placeholder="<?php echo $user->tel?>"></p>
			<p><label for="">是否为会员：</label><input type="text" name="vip" placeholder="<?php echo $user->vip?>"></p>
			<p><input type="submit" value="提交保存"></p>
		</form>
	</div>
	<footer id="footer">
		<ul>
			<li><a href="">关于我们</a></li>
			<li><a href="">联系我们</a></li>
		</ul>
		<p>黑ICP备11029623号-2 © 2016 版权所有</p>
	</footer>
</body>
</html>