<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="shortcut icon" href="__PUBLICK__/custom/images/"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- 新 Bootstrap 核心 CSS 文件 -->
		<link rel="stylesheet" href="/LFCMS/Public/bootstrap/css/bootstrap.min.css">		
		<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
		<script src="/LFCMS/Public/bootstrap/js/bootstrap.min.js"></script>
		
		<link rel="stylesheet" href="/LFCMS/Public/custom/css/index.css">	
	<title>后台管理</title>
	<style type="text/css">
		.right-line{
			border-right:1px gray dashed;
		}
	</style>
	<script>
		function checkData(){
			if(!$("#company").val()){
				alert("公司名称不能为空");
				return;
			}
			if(!$("#contact").val()){
				alert("联系人不能为空");
				return;
			}
			if(!$("#telphone").val()){
				alert("电话不能为空");
				return;
			}
			if(!$("#wechat").val()){
				alert("微信不能为空");
				return;
			}
			$.ajax({
				type:"POST",
				url:"/SignatureSystem/index.php/Home/index/checkRepeatData",
				data:{"company":$("#company").val(),"contact":$("#contact").val(),"telphone":$("#telphone").val(),"wechat":$("#wechat").val(),"position":$("#position").val(),"remarks":$("#remarks").val()},
				async:true,
				success: function (result){
					console.log(result.info);
					if(result.info > 0){
						alert("微信号已存在");
					}else{
						$.ajax({
							type:"POST",
							url:"/SignatureSystem/index.php/Home/index/addMemmber",
							data:{"company":$("#company").val(),"contact":$("#contact").val(),"telphone":$("#telphone").val(),"wechat":$("#wechat").val(),"position":$("#position").val(),"remarks":$("#remarks").val()},
							async:true,
							success: function (result){
								alert(result.info);
								if(result.info == "提交成功"){
									window.location.reload();
									clearText();
								}
							}
						});
					}
					
				}
			});
		}
		function clearText(){
			$("#company").val("");
			$("#contact").val("");
			$("#telphone").val("");
			$("#wechat").val("");
			$("#position").val("");
			$("#remarks").val("");
		}
	</script>
	</head>
	<body>
		<div style="background-color: black; height: 80px;">
			<div class="col-lg-4" style="color: white; line-height: 80px; font-size: 24px;">机械协会管理系统</div>
			<div class="pull-right">
				<button class="btn btn-danger" style="height: 40px; margin-top: 20px; margin-right: 20px;">退出登录</button>
			</div>
		</div>
		<div class="container-fluid" style="margin-top: 20px;">
			<div class="col-lg-1">
				<ul class="nav nav-pills nav-stacked right-line">
				  <li role="presentation" class="active"><a href="#">Home</a></li>
				  <li role="presentation"><a href="#">Profile</a></li>
				  <li role="presentation"><a href="#">Messages</a></li>
				</ul>
			</div>
			<div class="col-lg-11">
				<div>
						<form class="form-horizontal" action="/LFCMS/Home/Main/addMemmber" method="post" id="memmberDataForm">
						<div class="form-group">
							<label for="company" class="col-sm-3 control-label">公司名称<span style="color: red;">*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" placeholder="公司名称" name="company" id="company"/>
							</div>
						</div>
						<div class="form-group">
							<label for="company" class="col-sm-3 control-label">联系人<span style="color: red;">*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" placeholder="联系人" name="contact" id="contact"/>
							</div>
						</div>
						<div class="form-group">
							<label for="company" class="col-sm-3 control-label">电话<span style="color: red;">*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" placeholder="电话" name="telphone" id="telphone"/>
							</div>
						</div>
						<div class="form-group">
							<label for="company" class="col-sm-3 control-label">微信号<span style="color: red;">*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" placeholder="微信号" name="wechat" id="wechat"/>
							</div>
						</div>
						<div class="form-group">
							<label for="company" class="col-sm-3 control-label">职务</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" placeholder="职务" name="position" id="position"/>
							</div>
						</div>
						<div class="form-group">
							<label for="company" class="col-sm-3 control-label">备注</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" placeholder="备注" name="remarks" id="remarks"/>
							</div>
						</div>
						<div class="container">
							<div class="col-sm-2"></div>
							<div class="col-sm-4">
								<input type="button" class="btn btn-primary btn-lg btn-block" value="提交" onclick="checkData()"/>
							</div>
						</div>
					</form>
					</div>
			</div>
		</div>
	</body>
</html>