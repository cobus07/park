<!-- 用户首页 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户首页</title>
	<base href="<?php echo site_url()?>">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/userindex.css">
</head>
<body>
<!-- 扁平化设计 -->
	<!-- 用户session存储 -->
	<?php 
		$login_user = $this->session->userdata('login_user');
	        if(!$login_user) {
	        	redirect('welcome/index');
			}
	?>
	<div class="main">
		<h1>XX停车场管理系统用户首页</h1>
		<img src="imgs/user.jpg" alt="XX停车场管理系统用户首页">
		<!-- 左边tab 列表 -->
		<div class="list">
			<ul>
				<li class="user"><a href="javascript:;"><?php echo $login_user->username?>已登录</a></li>
				<li class="loginout"><a href="welcome/logout">退出账号</a></li>
				<li class="carsearch"><a href="javascript:;">车位查询</a></li>
				<li class="carreserve" data-user="<?php echo $login_user->user_id?>"><a href="javascript:;">车位预定</a></li>
				<li class="noreserve" data-user="<?php echo $login_user->user_id?>"><a href="javascript:;">车位离开</a></li>
				<li data-user="<?php echo $login_user->user_id?>" class="money"><a href="javascript:;">费用查询</a></li>
				<li data-user="<?php echo $login_user->user_id?>" class="record"><a href="javascript:;">积分查询</a></li>
				<li data-user="<?php echo $login_user->user_id?>" class="chongzhi"><a href="javascript:;">用户充值</a></li>
				<li data-user="<?php echo $login_user->user_id?>" class="chaxun"><a href="javascript:;">余额查询</a></li>
				<li data-user="<?php echo $login_user->user_id?>" class="vip"><a href="javascript:;">会员/非会员</a></li>
				<li data-user="<?php echo $login_user->user_id?>" class="index"><a href="welcome/goindex">返回首页</a></li>

			</ul>
		</div>
		<!-- 右边tab 内容 -->
		<div class="go">
			<div class="user">
		            <form action="welcome/update_user" method="post">
						<p><input type="text" hidden="hidden" name="userid" value="<?php echo $login_user->user_id?>"></p>
						<p>用户:<input type="text" name="username" value="<?php echo $login_user->username?>" /></p>
						<p>密码:<input type="text" name="password" value="<?php echo $login_user->password?>" /></p>
						<p>车牌:<input type="text" name="car" value="<?php echo $login_user->carno?>" /></p>
						<p>电话:<input type="text" name="tel" value="<?php echo $login_user->tel?>" /></p>
						<p><input type="submit" value="修改保存"></p>
					</form>
			</div>
			<!-- 退出当前账号 -->
			<div class="loginout">
				<p>已退出当前账号。</p>
			</div>
			<!-- 一进页面刷新 车位查询 -->
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
			<!-- 车位预定 -->
			<div class="search">
				<table class="ajax-reserve-b" border="1px solid #000" width="300px" cellspacing="0">
					<tr>
						<th>序号</th>
						<th>已占用车位</th>
						<th>所属用户</th>
					</tr>
				</table>
				<table class="ajax-reserve-w" border="1px solid #000" width="230px" cellspacing="0">
					<tr>
						<th>序号</th>
						<th>未占用车位</th>
						<th>预定车位</th>
					</tr>
				</table>
			</div>
			<!-- 车位离开 -->
			<div class="out">
				<table class="out" border="1px solid #000" width="400px" cellspacing="0">
					<tr>
						<th>序号</th>
						<th>您当前预定的车位为</th>
						<th>车位预定时间</th>
						<th>是否离开</th>
					</tr>
				</table>
			</div>
			<!-- 费用记录 -->
			<div class="money-search">
				<table class="mymoney" border="1px solid #000" cellspacing="0" width="600">
					<tr>
						<th>序号</th>
						<th>消费记录</th>
						<th>消费金额</th>
						<th>总消费金额</th>
					</tr>
				</table>
				<p>tip:消费金额满1000元可升级为vip会员！</p>
			</div>
			<!-- 积分记录 -->
			<div class="record">
				<table class="myrecord" border="1px solid #000" cellspacing="0" width="600">
					<tr>
						<th>序号</th>
						<th>消费记录</th>
						<th>单次积分</th>
						<th>总积分</th>
					</tr>
				</table>
				<p>tip:累计积分满1000点可升级为vip会员！</p>
			</div>
			<!-- 充值查询 -->
			<div class="chongzhi">
				<form action="Welcome/chongzhi" method="post">
					<input type="hidden" name="userid" value="<?php echo $login_user->user_id?>">
					<input type="text" name="money" placeholder="请输入充值金额">
					<input type="submit" value="充值">
				</form>
				<p>tip:累计积分满1000点可升级为vip会员！(一元 = 一积分)</p>
			</div>
			<!-- 余额查询 -->
			<div class="yue">
				
			</div>
			<!-- 会员非会员查询 -->
			<div class="vip">
				<h3>会员优惠</h3>
				<p>单次充值1000元可直接升级为vip会员</p>
				<p>并享受8折优惠！</p>
				<p><?php if($login_user->vip === '1'){
						echo "您已是会员，无需升级";
					?>
					<?php
					}else{
						echo "您还不是会员，请快去升级吧！";
						}
					?></p>
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
	<script type="text/javascript" src="js/userindex.js"></script>
</body>
</html>