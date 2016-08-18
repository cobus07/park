// 用户首页js文件
// jqurey 文档就绪函数
$(function(){
	var $Li = $('.list li');
	$Li.on('click',function(){
		var index = $Li.index(this);
		var $Div = $('div.go > div');
		$Div.eq(index).addClass('selected').siblings().removeClass('selected');
	});
	// 每一个tab内容 都是通过ajax的方式从数据库获取，之后通过回调函数动态的插入到页面中

	// 车位预定
	var $reserve = $('li.carreserve');
	var flag1 = true;
	$reserve.on('click',function(){
		// 给tab按钮注册单击事件
		if(flag1){
			$.get('welcome/ajax_get_reserve?statusb=black&statusw=white',function(res){
			console.log(res);
			// 通过jquery中$.get(url,callback,datatype)方法进行ajax交互
			for(var i=0; i<res.data_b.length; i++){
				var carposition_b = res.data_b[i];
				html1='<tr>'
						+'<td>'+i+'</td>'
						+'<td>'+carposition_b.number+'</td>'
						+'<td>'+carposition_b.owner+'</td>'
					+'</tr>';
				$('table.ajax-reserve-b').append(html1);
			}
			for(var i=0; i<res.data_w.length; i++){
				var carposition_w = res.data_w[i];
				html2='<tr>'
						+'<td>'+i+'</td>'
						+'<td>'+carposition_w.number+'</td>'
						+'<td><button class="reserve" data-id="'+carposition_w.number+'" data-owner="'+carposition_w.owner+'">预定</button></td>'
					+'</tr>';
				$('table.ajax-reserve-w').append(html2);
			}
			$('button.reserve').on('click',function(){
				$that = $(this);
				$owner = $('.carreserve');
				// var myDate = new Date();
				// intime=myDate.toLocaleTimeString();     //获取当前时间
				$.post('welcome/post_reserve',{reserve_id:$that.data('id'),user_id:$owner.data('user')},function(data){
					console.log(data);
					// 这是jquery中$.post(url,aguments,callback,datatype)方法;
					// 回调函数里面的参数 就是 ajax 返回的数据
					if(data == 'success'){
						alert('预定成功！');
						location.href = "welcome/login_success";
					}else{
						alert('预定失败！');
					}
				});
			});
		},'json');
			flag1 = false;
		}
		
	});
	// 车位离开
	$out = $('li.noreserve');
	flag2 = true;
	$out.on('click',function(){
		$that = $(this);
		if(flag2){
			$.get('Welcome/get_reserve',{userid:$that.data('user')},function(res){
			console.log(res);
			if(res.myposition.length == 0){
					$('table.out').remove();
					$('div.out').append('<h2 style="text-align:center">暂无预约记录</h2>');
				}else{
					for(var i=0; i<res.myposition.length; i++){
						var myposition = res.myposition[i];
						html4 = '<tr>'
									+'<td>'+(i+1)+'</td>'
									+'<td>'+myposition.number+'</td>'
									+'<td></td>'
									+'<td><button data-id="'+myposition.id+'" data-status="white" class="noreserve">离开</button></td>'
								+'</tr>';
							$('table.out').append(html4);
					}
					$('button.noreserve').on('click',function(){
						$that = $(this);
						$owner = $('li.noreserve');
						console.log($owner.data('user'));
						// var myDate = new Date();
						// var outtime=myDate.toLocaleTimeString();     //获取当前时间
						$.post('welcome/post_noreserve',{positionid:$that.data('id'),status:$that.data('status'),owner:$owner.data('user')},function(data){
							if(data == 'success'){
								alert('离开成功！');
								$that.parent('td').parent('tr').remove();
							}else{
								alert('离开失败！');
							}
						},'text');
					});
				}
		},'json');
			flag2 = false;
		}
		
	});
	// 费用查询
	$money = $('li.money');
	flag = true;
	$money.on('click',function(){
		// var userid = $(this).data('user');
		$that = $(this);
		if(flag){
			$.get('welcome/get_money',{userid:$that.data('user')},function(res){
				console.log(res);
				if(res.mymoney.length == 0){
					$('table.mymoney').remove();
					$('div.money-search').append('<h2 style="text-align:center">暂无消费记录</h2>');
				}else{
					for(var i=0; i<res.mymoney.length; i++){
						var mymoney = res.mymoney[i];
						var total = 0;
						for(var j=0; j<res.mymoney.length; j++){
							var money = res.mymoney[j];
							total += Number(money.money);
						}
						if(i == 0){
							html5 = '<tr>'
										+'<td>'+(i+1)+'</td>'
										+'<td>'+mymoney.addtime+'</td>'
										+'<td>'+mymoney.money+'</td>'
										+'<td rowspan="'+res.mymoney.length+'">'+total+'</td>'
									+'</tr>';
						}else{
							html5 = '<tr>'
										+'<td>'+(i+1)+'</td>'
										+'<td>'+mymoney.addtime+'</td>'
										+'<td>'+mymoney.money+'</td>'
									+'</tr>';
						}
						$('table.mymoney').append(html5);
					}
				}
				
			},'json');
			flag = false;
		}
		
	});
	// 积分查询
	$record = $('li.record');
	flag3 = true;
	$record.on('click',function(){
		$that = $(this);
		if(flag3){
			$.get('welcome/get_record',{userid:$that.data('user')},function(res){
				console.log(res);
				if(res.myrecord.length == 0){
					$('table.myrecord').remove();
					$('div.record').append('<h2 style="text-align:center">暂无积分记录</h2>');
				}else{
						
					for(var i=0; i<res.myrecord.length; i++){
						var myrecord = res.myrecord[i];
						var total = 0;
						for(var j=0; j<res.myrecord.length; j++){
							var record = res.myrecord[j];
							total += Number(record.record);
						}
						if(i == 0){
							html6 = '<tr>'
										+'<td>'+(i+1)+'</td>'
										+'<td>'+myrecord.addtime+'</td>'
										+'<td>'+myrecord.record+'</td>'
										+'<td rowspan="'+res.myrecord.length+'">'+total+'</td>'
									+'</tr>';
						}else{
							html6 = '<tr>'
										+'<td>'+(i+1)+'</td>'
										+'<td>'+myrecord.addtime+'</td>'
										+'<td>'+myrecord.record+'</td>'
									+'</tr>';
						}
						$('table.myrecord').append(html6);	
					}
				}
			},'json');
			flag3 = false;
		}
	});
	// 余额查询
	$yue = $("li.chaxun");
	flag7 = true;
	$yue.on('click',function(){
		$that = $(this);
		$.post('Welcome/chaxun',{userid:$that.data('user')},function(res){
			console.log(res);
			$("div.yue").html(
					"<p>您目前的账户余额为：&nbsp;"+res.user.money+"</p>"
						+"<p>tip:累计积分满1000点可升级为vip会员！(一元 = 一积分)</p>;"
				);
		},'json');
		flag7 = false;
	});
	// 用户会员状态
	$govip = $('a.govip');
	$govip.on('click',function(){
		$that = $(this);
		$.post('welcome/go_vip',{userid:$that.data('id'),uservip:$that.data('vip')},function(res){
			if(res == 'success'){
				alert('升级成功！');
				$that.parent('p').prev().text('您已是会员，无需升级');
			}else{
				alert('升级失败！');
			}
		});
	});
	

});