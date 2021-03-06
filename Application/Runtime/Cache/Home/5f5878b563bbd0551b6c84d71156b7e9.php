<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="shortcut icon" href="__PUBLICK__/custom/images/"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- 新 Bootstrap 核心 CSS 文件 -->
		<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">		
		<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
		<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
		<link rel="stylesheet" href="/LFCMS/Public/custom/css/index.css">	
	<title>后台管理</title>
	<script>
		$(function(){
			var verfy_img = $("#verifyCode");
			var verifyimg = verfy_img.attr("src");
			verfy_img.click(function(){
				if( verifyimg.indexOf('?')>0){  
			        $(this).attr("src", verifyimg+'&random='+Math.random());  
			    }else{  
			        $(this).attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());  
			    } 
			});
		});
		function login(){
//			$("#loginForm").submit();
			var account = $("#account").val();
			var pwd = $("#pwd").val();
			var verify = $("#verify").val();
			if(!account){
				alert("请填写用户名");
				return;
			}
			if(!pwd){
				alert("请填写密码");
				return;
			}
			if(!(verify.length == 4)){
				alert("请填写4数的位验证码");
				return;
			}
			$.ajax({
				type:"post",
				url:"Home/Index/login",
				async:true,
				data:{"account":account,"pwd":pwd,"verify":verify},
				success:function(res){
					console.log(res.info);
					if(res.info == "ok"){
						location.href = 'Home/Main/Index';
					}else{
						alert(res.info);
						location.reload();
					}
					
				}
			});
		}
	</script>
	</head>
	<body>
		<div class="container content">
			<div class="row">
				<div class="col-xs-12 text-center" style="background-color: black; color: white; height: 30px; line-height: 30px; font-size: 17px; border-radius: 8px 8px 0 0; opacity: 0.8;">
					登陆
				</div>
			</div> 
			<div class="row" style="margin-top: 20px;"> 
				<form class="form-horizontal" action="Home/Index/login" method="post" name="loginForm" id="loginForm">
					<div class="form-group">
						<label for="company" class="col-sm-2 control-label">账号</label>
							<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="请输入账号" name="company" id="account"/>
						</div>
					</div>
					<div class="form-group">
						<label for="company" class="col-sm-2 control-label">密码</label>
							<div class="col-sm-8">
							<input type="password" class="form-control" placeholder="请输入密码" name="company" id="pwd"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2"></div>
						<div class="col-sm-4">
	  						<input id="verify" name="verify" width="50%" height="50" class="captcha-text form-control col-sm-2" placeholder="验证码" type="text">                  
	 					 	  
						</div>
						<img id="verifyCode" width="30%" class="left15" height="50" alt="验证码" src="<?php echo U('Home/Index/verify_c',array());?>" title="点击刷新">
					</div>
					<div class="center-block">
						<div class="col-sm-2"></div>
						<input type="button" value="登陆" class="btn btn-primary col-sm-8" onclick="login()" />
					</div>
				</form>
			</div> 
		</div>
	</body>
</html>