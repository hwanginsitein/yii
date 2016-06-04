<!DOCTYPE html>
<html>
	<head>
		<title>赣中律师事务所 -- 注册页面</title>
		<script src="/resources/jquery.js"></script>
		<script src="/resources/modernizr.js"></script>
		<script src="/js/layer/layer.js"></script>
		<link href="/resources/style.css" rel="stylesheet" type="text/css" />
		<link href="/resources/pnf.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="content">
			<div id="register_box">
				<div id="head">
					<h1>注册账号</h1>
				</div>
				<div id="main_box">
					<form class="register" method='POST'>
						<h1>注册</h1>
						<br />
						
						<div class="text">
							<img src="/resources/images/username.png" alt="用户名" />
							<input type="text" name="username" placeholder="用户名" /><br />
						</div>
						<div class="text">
							<img src="/resources/images/password.png" alt="密码" />
							<input type="password" name="password" placeholder="密码" /><br />
						</div>	
						<div class="text">
							<img src="/resources/images/password.png" alt="确认密码" />
							<input type="password" name="repassword" placeholder="确认密码" /><br />
						</div>	
						<div class="text">
							<img src="/resources/images/phone.png" width=16 height=16 alt="手机号" />
							<input type="text" name="phone" placeholder="手机号" /><br />
						</div>	
						
						<input type="submit" value="注册" />				
						<div class="login">
							已经注册过?
							<a href="/user/login">登录</a>
						</div>
					</form>
					<div class="right_box">
						<div id="benefits">
							<h1>请点击图片选择您的身份</h1>
							<br />
							<ul>
								<li>
									<div class="he" role=1><img src='/resources/images/lawfirm.png' /></div>
									<div>律师</div>
								</li>
								<li>
									<div class="he" role=2><img src='/resources/images/company.png' /></div>
									<div>电信工作人员</div>
								</li>
								<li>
									<div class="he" role=3><img src='/resources/images/debtor.png' /></div>
									<div>欠款用户</div>
								</li>
							</ul>
						</div>
						<br /><br /><br />
						<div id="facebook-con">
							<h1>赣中律师事务所</h1>
							<br />
						</div>
						<div class="fbl">
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
var role = false;
$('.he').click(function(){
	role = $(this).attr('role');
	$('.he').removeClass('redborder');
	$(this).addClass('redborder');
})
$('form').submit(function(){
	if(role==false){
		layer.msg('请选择用户身份',{icon:2});return false;
	}
	if($('[name=username]').val() == ''){
		layer.msg('请输入用户名',{icon:2});return false;
	}
	if($('[name=password]').val()==''){
		layer.msg('请输入密码',{icon:2});return false;
	}
	if($('[name=password]').val() != $('[name=repassword]').val()){
		layer.msg('两次密码不相同',{icon:2});return false;
	}
	var url = $(this).attr('action');
	var self = $(this);
	$.ajax({
		type:'POST',
		url:url,
		data:self.serialize()+"&role="+role,
		success:function(d){
			console.log(d);
			obj = JSON.parse(d);
			if(obj.status == 1){
				window.location.href = '/user/login';
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