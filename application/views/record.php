<!-- 积分编辑 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑</title>
	<base href="<?php echo site_url();?>">
	<link rel="stylesheet" href="css/main.css">
	<style>
		#container{
			width: 270px;
			height: 300px;
			border: 2px solid #333;
			box-shadow: 3px 3px 3px #eee;
			border-radius: 10px;
			margin: 50px auto;
		}
		h3{
			text-align: center;
		}
		p{
			width: 170px;
			margin: 20px auto;
		}
		input{
			outline: none;
			width: 170px;
			height: 30px;
			border-radius: 5px;
			text-indent: 5px;
		}
		input[type=submit]{
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div id="container">
		<h3>编辑</h3>
		<form action="admin/adminrecord" method="post">
			<input type="text" hidden="hidden" name="userid" value="<?php echo $records->user_id?>">
			<p><input type="text" name="record" placeholder="<?php echo $records->record?>"></p>
			<p><input type="text" name='addtime' placeholder="<?php echo $records->addtime?>"></p>
			<p><input type="submit" value="提交保存"></p>
		</form>
	</div>
</body>
</html>