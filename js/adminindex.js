// 管理员js文件
// jquery文档就绪函数
$(function(){
	var $Li = $('.list li');
	$Li.on('click',function(){
		var index = $Li.index(this);
		var $Div = $('div.go > div');
		$Div.eq(index).addClass('selected').siblings().removeClass('selected');
	});

	// 每一个tab内容 都是通过ajax的方式从数据库获取，之后通过回调函数动态的插入到页面中

	// 车位管理
	var $caradmin = $('li.caradmin');
	var flag = true;
	$caradmin.on('click',function(){
		if(flag){
			$.get('admin/ajax_admincar',function(res){
			console.log(res);
			for(var i=0; i<res.cars.length; i++){
				var cars = res.cars[i];
				var status;
				if(cars.status == 'black'){
					status = '该车位已占';
				}else{
					status = '该车位未占';
				}
				html7 = '<tr>'
							+'<td>'+(i+1)+'</td>'
							+'<td>'+cars.number+'</td>'
							+'<td>'+status+'</td>'
							+'<td><button data-id="'+cars.id+'" class="del">删除</button></td>'
						+'</tr>'
				$('table.caradmin').append(html7);
			}
			$('button.del').on('click',function(){
				$that = $(this);
				$.post('admin/post_del_car',{car_id: $that.data('id')},function(data){
					if(data == 'success'){
						alert('删除成功!');
						$that.parent('td').parent('tr').remove();
						location.href = 'admin/login_success';
					}else{
						alert('删除失败!');
					}
				})
			});
		},'json');
			flag = false;
		}
	});
	// 解除预定
	var $carout = $('li.carout');
	var flag1 = true;
	$carout.on('click',function(){
		$that = $(this);
		if(flag1){
			$.get('admin/ajax_carout',function(resp){
			console.log(resp);
			for(var i=0; i<resp.cars.length; i++){
				var cars = resp.cars[i];
				var status;
				if(cars.status == 'black'){
					status = '该车位已占';
				}else{
					status = '该车位未占';
				}
				var statusout = '该车位未占';
				html8 = '<tr>'
							+'<td>'+cars.username+'</td>'
							+'<td>'+cars.number+'</td>'
							+'<td>'+cars.tel+'</td>'
							+'<td>'+status+'</td>'
							+'<td><button data-id="'+cars.id+'" data-status="'+statusout+'" class="carout">解除预定</button></td>'
						+'</tr>';
				$('table.carremove').append(html8);
			}
			$('button.carout').on('click',function(){
				$that = $(this);
				$.post('admin/post_out_car',{id: $that.data('id'), statusout:'$that.data(statusout)'},function(data){
					
					if(data == 'success'){
						alert('解约成功！');
						$that.parent('td').prev('td').text('该车位未占');
					}else{
						alert('解约失败！');
					}
				});
			});
		},'json');
		}
		flag1 = false;
	});
	// 用户管理
	var $adminuser = $('li.adminuser');
	var flag3 = true;
	$adminuser.on('click',function(){
		if(flag3){
			$.get('admin/get_user',function(res){
			console.log(res);
			for(var i=0; i<res.users.length; i++){
				var users = res.users[i];
				var isvip;
				if(users.vip == '1'){
					isvip = '会员';
				}else{
					isvip = '非会员';
				}
				html9 = '<tr>'
							+'<td>'+(i+1)+'</td>'
							+'<td>'+users.username+'</td>'
							+'<td>'+users.password+'</td>'
							+'<td>'+users.carno+'</td>'
							+'<td>'+users.tel+'</td>'
							+'<td>'+isvip+'</td>'
							+'<td><button class="deluser" data-id="'+users.user_id+'">删除</button></td>'
							+'<td><a href="admin/adminuser?userid='+users.user_id+'">编辑</a></td>'
						+'</tr>';
				$('table.useradmin').append(html9);
			}
			$('button.deluser').on('click',function(){
				$that = $(this);
				$.post('admin/post_deluser',{userid:$that.data('id')},function(data){
					if(data == 'success'){
						$that.parents('tr').remove();
						alert('删除成功!');
					}else{
						alert('删除失败!');
					}
				},'text');
			});
		},'json');
		}
		
		flag3 = false;
	});
	// 费用管理
	var $moneyadmin = $('li.moneyadmin');
	var flag4 = true;
	$moneyadmin.on('click',function(){
		if(flag4){
			$.get('admin/get_money', function(res){
			console.log(res);
			for(var i=0; i<res.usermoney.length; i++){
				var usermoney = res.usermoney[i];
				var total = Number(usermoney.money);
				for(var j=0; j<res.usermoney.length; j++){
					total += total;
				}
				html6 = '<tr>'
							+'<td>'+usermoney.username+'</td>'
							+'<td>'+usermoney.money+'</td>'
							+'<td>'+usermoney.money+'</td>'
							+'<td>'+usermoney.money+'</td>'
							+'<td>'+usermoney.addtime+'</td>'
							+'<td>'+total+'</td>'
							+'<td><a href="javascript:;">已支付</a></td>'
						+'</tr>';
				$('table.moneyadmin').append(html6);
			}
		},'json');
			flag4 = false;
		}
	});
	// 积分管理
	var $recordadmin = $('li.recordadmin');
	var flag5 = true;
	$recordadmin.on('click',function(){
		if(flag5){
			$.get('admin/get_record',function(res){
			console.log(res);
			for(var i=0; i<res.userrecord.length; i++){
				var userrecord = res.userrecord[i];
				var total = Number(userrecord.record);
				for(var j=0; j<res.userrecord.length; j++){
					total += total;
				}
				html = '<tr>'
							+'<td>'+userrecord.username+'</td>'
							+'<td>'+userrecord.record+'</td>'
							+'<td>'+userrecord.addtime+'</td>'
							+'<td>'+total+'</td>'
							// +'<td><a href="admin/bianjirecord?userid='+userrecord.user_id+'">编辑</a></td>'
						+'</tr>';
				$('table.recordadmin').append(html);
			}
		},'json');
			flag5 = false;
		}
		
	});
	// 充值管理

	var $adminchongzhi = $('li.adminchongzhi');
	var flag0 = true;
	$adminchongzhi.on('click',function(){
		if (flag0) {
				$.get('admin/chongzhi',function(data){
			console.log(data);

			for(var i=0; i<data.userchongzhi.length; i++){
				var userchongzhi = data.userchongzhi[i];
 				html0 = '<tr>'
							+'<td>'+userchongzhi.username+'</td>'
							+'<td>'+userchongzhi.money+'</td>'
						+'</tr>';
				$('table.chongzhi').append(html0);
			}
		},'json');
				flag0 = false;
			}
		
	});
	// 会员/非会员管理
	var $vipadmin = $('li.vipadmin');
	var flag6 = true;
	$vipadmin.on('click',function(){
		if(flag6){
			$.get('admin/get_vip',function(res){
			console.log(res);
			for(var i=0; i<res.uservip.length; i++){
				var uservip = res.uservip[i];
				var isvip;
				if(uservip.vip == '1'){
					isvip = '会员';
				}else{
					isvip = '非会员';
				}
				html = '<tr>'
							+'<td>'+uservip.username+'</td>'
							+'<td>'+uservip.money+'</td>'
							+'<td>'+isvip+'</td>'
							+'<td><button data-id="'+uservip.user_id+'" data-vip="1" class="delvip">降级</button></td>'
							+'<td><button class="govip" data-id="'+uservip.user_id+'" data-vip="0">升级</button></td>'
						+'</tr>';
				$('table.vipadmin').append(html);
			}
			$('button.delvip').on('click',function(){
				$that = $(this);
				$.post('admin/post_delvip',{userid:$that.data('id'),uservip:$that.data('vip')},function(data){
					console.log(data);
					if(data == 'success'){
						alert('降级成功!');
						$that.parent('td').prev().text('非会员');
					}else{
						alert('降级失败！');
					}
				},'text');
			});
			$('button.govip').on('click',function(){
				$that = $(this);
				$.post('admin/post_govip',{userid:$that.data('id'),uservip:$that.data('vip')},function(data){
					console.log(data);
					if(data == 'success'){
						alert('升级成功!');
						$that.parent('td').prev().prev().text('会员');
					}else{
						alert('升级失败！');
					}
				},'text');
			});
		},'json');
			flag6 = false;
		}
	});
});