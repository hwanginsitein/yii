<!DOCTYPE html>
<html>
	<head>
		<title>赣中律师事务所 登录页面</title>
		<script src="/resources/jquery.js"></script>
		<script src="/resources/modernizr.js"></script>
		<script src="/js/layer/layer.js"></script>
		<link href="/resources/style.css" rel="stylesheet" type="text/css" />
		<link href="/resources/pnf.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<div class="content">
			<div id="register_box">
				<div id="head">
					<h1>登录账号</h1>
				</div>
				<div id="main_box">
					<form class="register" method='POST' action="/user/login">
						<h1>登录</h1>
						<br />
						
						<div class="text">
							<img src="/resources/images/username.png" alt="用户名" />
							<input type="text" name="username" placeholder="用户名" /><br />
						</div>
						<div class="text">
							<img src="/resources/images/password.png" alt="密码" />
							<input type="password" name="password" placeholder="密码" /><br />
						</div>
						<input type="submit" value="登录" />				
						<div class="login">
							还未注册过?
							<a href="/user/register">注册</a>
						</div>
					</form>
					<div class="right_box">
						<div style="text-align:center">
							<h4>赣中律师事务所</h4>
						</div>
					</div>
				</div>
				<div id="footer_box">
				</div>
			</div>
		</div>
	</body>
</html>
<script>
$('form').submit(function(){
	if($('[name=username]').val() == ''){
		layer.msg('请输入用户名');return false;
	}
	if($('[name=password]').val()==''){
		layer.msg('请输入密码');return false;
	}
	var url = $(this).attr('action');
	var self = $(this);
	$.ajax({
		type:'POST',
		url:url,
		data:self.serialize(),
		success:function(d){
			console.log(d);
			obj = JSON.parse(d);
			if(obj.status == 1){
				window.location.href = '/admin';
			}else{
				var errors = obj.error;
				var errorInfo = '';
				for(p in obj.error){
					errorInfo += obj.error[p]+"<br>";
				}
				layer.msg(errorInfo,{time:10000,icon:2});
			}
		}
	})
	return false;
})
</script>