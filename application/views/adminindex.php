<!-- 管理员首页 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理员首页</title>
	<base href="<?php echo site_url();?>">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/adminindex.css">
</head>
<body>
<!-- 扁平化设计 -->
<!-- session数据存储 -->
	<?php 
		$login_admin = $this->session->userdata('login_admin');
	        if(!$login_admin) {
	        	redirect('admin/login');
			}
	?>
	<div class="main">
		<h1>XX停车场管理系统管理员首页</h1>
		<img src="imgs/user.jpg" alt="XX停车场管理系统管理员首页">
		<!-- 左边tab列表 -->
		<div class="list">
			<ul>
				<li><a href="javascript:;"><?php echo $login_admin->adminname?>已登录</a></li>
				<li><a href="admin/logout">退出账号</a></li>
				<li><a href="javascript:;">车位查询</a></li>
				<li class="caradmin"><a href="javascript:;">车位管理</a></li>
				<li class="carout"><a href="javascript:;">解除预定</a></li>
				<li class="adminuser"><a href="javascript:;">用户管理</a></li>
				<li class="moneyadmin"><a href="javascript:;">费用管理</a></li>
				<li class="recordadmin"><a href="javascript:;">积分管理</a></li>
				<li class="adminchongzhi"><a href="javascript:;">充值管理</a></li>
				<li class="vipadmin"><a href="javascript:;">会员/非会员管理</a></li>
				<li class="chefei"><a href="admin/chefeiadmin">车费管理</a></li>
				<li class="index"><a href="admin/goindex">返回首页</a></li>
			</ul>
		</div>
		<!-- 右边tab内容 -->
		<div class="go">
		<!-- 管理员个人信息资料 -->
			<div class="admin">
				<form action="admin/update_admin" method="post">
						<p><input type="text" hidden="hidden" name="userid" value="<?php echo $login_admin->admin_id?>"></p>
						<p>用户:<input type="text" name="adminname" value="<?php echo $login_admin->adminname?>" /></p>
						<p>密码:<input type="text" name="password" value="<?php echo $login_admin->password?>" /></p>
						<p>电话:<input type="text" name="tel" value="<?php echo $login_admin->tel?>" /></p>
						<p><input type="submit" value="修改保存"></p>
				</form>
			</div>
			<!-- 退出当前账号，退出当前session -->
			<div class="loginout">
				<p>已退出当前账号。</p>
			</div>
			<!-- 页面一刷新显示的部分 车位查询 -->
			<div class="content selected">
				<ul class="top">
					<?php 
						foreach ( $cars as $car) {
					?>
						<?php 
							if($car->status == 'white'){
						?>
							<li><a style="background-color: <?php echo $car->status?>" href="javascript:;" title="<?php echo $car->number?>"></a></li>
						<?php 
							}else{
						?>
							<li><a style="background-color: <?php echo $car->status?>" href="javascript:;" title="<?php echo $car->number?>"><img src="imgs/car.jpg" alt="" style="width: 30px; height: 50px"></a></li>
						<?php
							}
						?>
					<?php 
						}
					?>
				</ul>
				<ul class="bottom">
				</ul>
				<div class="logo">
					<p>
						<span class="yes is"></span>
						<span class="des">未停车</span>
					</p>
					<p>
						<span class="no is"><img src="imgs/car.jpg" alt="" style="width: 30px; height: 50px;"></span>
						<span class="des">已停车</span>
					</p>
				</div>
			</div>
			<!-- 车位管理 -->
			<div class="caradmin">
				<table class="caradmin" border="1px solid #000" width="500px" cellspacing="0">
					<tr>
						<th>序号</th>
						<th>车位编号</th>
						<th>车位状态</th>
						<th>删除车位</th>
					</tr>
				</table>
				<form action="admin/post_save_car" method="post">
					<p><input type="text" name="carno" placeholder="请输入车位编号"></p>
					<p><input type="text" name="carstatus" placeholder="请输入车位状态(未占/已占)"></p>
					<p><input class="savecar" type="submit" value="添加车位"></p>
				</form>
			</div>
			<!-- 车位解除预定 -->
			<div class="remove">
				<table class="carremove" border="1px solid #000" width="500px" cellspacing="0">
					<tr>
						<th>用户名</th>
						<th>车位编号</th>
						<th>电话</th>
						<th>状态</th>
						<th>解除预定</th>
					</tr>
					
				</table>
			</div>
			<!-- 用户管理 -->
			<div class="useradmin">
				<table class="useradmin" border="1px solid #000" width="600px" cellspacing="0">
					<tr>
						<th>序号</th>
						<th>用户名</th>
						<th>用户密码</th>
						<th>车牌号</th>
						<th>联系电话</th>
						<th>会员/非会员</th>
						<th>删除</th>
						<th>编辑</th>
					</tr>
				</table>
			</div>
			<!-- 用户费用管理 -->
			<div class="moneyadmin">
				<table class="moneyadmin" border="1px solid #000" cellspacing="0" width="600">
					<tr>
						<th>用户名</th>
						<th>费用</th>
						<th>交费情况</th>
						<th>进站时间</th>
						<th>出站时间</th>
						<th>总消费</th>
						<th>编辑</th>
					</tr>
				</table>
			</div>
			<!-- 用户积分管理 -->
			<div class="recordadmin">
				<table class="recordadmin" border="1px solid #000" cellspacing="0" width="500">
					<tr>
						<th>用户名</th>
						<th>单次积分</th>
						<th>消费记录</th>
						<th>总积分</th>
					</tr>
				</table>
			</div>
			<!-- 用户充值管理 -->
			<div class="chongzhi">
				<table class="chongzhi" border="1px solid #000" cellspacing="0" width="500">
					<tr>
						<th>用户名</th>
						<th>充值记录</th>
					</tr>
				</table>
			</div>
			<!-- 用户会员非会员状态管理 -->
			<div class="vipadmin">
				<table class="vipadmin" border="1px solid #000" cellspacing="0" width="500">
					<tr>
						<th>用户名</th>
						<th>用户积分</th>
						<th>是否为会员</th>
						<th>降级</th>
						<th>升级</th>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="footer">
		<h2>欢迎下次光临！</h2>
		<p>黑ICP备11029623号-2 © 2016 版权所有</p>
		<ul>
			<li>关于我们</li>
			<li>联系我们</li>
		</ul>
	</div>
	<script src="js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="js/adminindex.js"></script>
</body>
</html>