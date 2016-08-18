$(function(){

	var $username = $('[name="username"]');
	$username.on('blur',function(){
		var $this = $(this);
		var username = $this.val();
		console.log(username);
		$.get('welcome/check_username?name=username',function(res){
			if(res == 'fail'){
				alert('该用户已存在！');
			}else{
				alert('该用户名可以注册')
			}
		},'text');
	});

});