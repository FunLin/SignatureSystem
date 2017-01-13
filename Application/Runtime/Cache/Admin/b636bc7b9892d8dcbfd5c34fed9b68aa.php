<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/SignatureSystem/Public/admin/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/SignatureSystem/Public/admin/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/SignatureSystem/Public/admin/Css/style.css" />
    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/jquery.js"></script>
    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/ckform.js"></script>
    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/common.js"></script>
    <script type="text/javascript" src="/SignatureSystem/Public/layer/layer.min.js"></script>
    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }


    </style>
</head>
	<form method="post" action="<?php echo U('index.php/Admin/AllMemmber/import','','');?>" enctype="multipart/form-data" style="margin-top: 20px; margin-left: 40px;">
	   <input type="file" name="excel" style="width:200px">
	   <button type="submit" class="btn btn-success glyphicon glyphicon-plus">导入</button>
	</form>
<form action="index.html" method="post">
<table class='table table-bordered table-hover definewidth m10'>
    <!--<tr>
        <td width='10%' class='tableleft'>机构编号</td>
        <td><input type='text' name='grouptitle'/></td>
    </tr>-->
    <tr>
        <td class='tableleft'>机构名称<span style='color: red;'>*</span></td>
        <td><input type='text' name='moduletitle' id="company"/></td>
    </tr>
    <tr>
        <td width='10%' class='tableleft'>联系人<span style='color: red;'>*</span></td>
        <td><input type='text' name='grouptitle' id="contact"/></td>
    </tr>
    <tr>
        <td width='10%' class='tableleft'>联系电话<span style='color: red;'>*</span></td>
        <td><input type='text' name='grouptitle' id="telphone"/></td>
    </tr>
    <tr>
        <td class='tableleft'>微信号<span style='color: red;'>*</span></td>
        <td><input type='text' name='moduletitle' id="wechat"/></td>
    </tr>
    <tr>
        <td class='tableleft'>职务</td>
        <td><input type='text' name='moduletitle' id="positions"/></td>
    </tr> 
    <tr>
        <td class='tableleft'>备注</td>
        <td><input type='text' name='moduletitle' id="remark"/></td>
    </tr> 
    <tr>
        <td class='tableleft'>是否会员</td>
	        <td>
		        	<form role="form">
				   <div class="form-group">
				      <select class="form-control" id="isMemmber">
					         <option>是</option>
					         <option>否</option>
					      	</select>
				   </div>
				</form>

	        </td>
    </tr> 
    <!--<tr>
        <td class='tableleft'>状态</td>
        <td>
            <input type='radio' name='status' value='1' checked/> 启用
            <input type='radio' name='status' value='0'/> 禁用
        </td>
    </tr>-->
    <tr>
        <td class='tableleft'></td>
        <td>
            <button class='btn btn-primary' type='button' onclick="addMemmber()">保存</button>&nbsp;&nbsp;<button type='button' class='btn btn-success' name='backid' id='backid'>返回列表</button>
        </td>
    </tr>
</table>
</form>
</body>
</html>
<script>
	function addMemmber(){
		var company = $("#company").val();
		var contact = $("#contact").val();
		var telphone = $("#telphone").val();
		var wechat = $("#wechat").val();
		var positions = $("#positions").val();
		var remark = $("#remark").val();
		var isMemmber = $("#isMemmber").find("option:selected").val();
		$.ajax({
			type:"post",
			url:"/SignatureSystem/Admin/AllMemmber/addMemmber",
			async:true,
			data:{"company":company,"contact":contact,"telphone":telphone,"wechat":wechat,"position":positions,"remarks":remark,"isMemmber":isMemmber},
			success: function (res) {
				if(res.info == '1'){
//					layer.tips('默认没有关闭按钮', this , {guide: 1, time: 2});
//					alert('添加成功');
					layer.msg("添加成功",1);

					clearText();
				}else{
					alert('添加失败');
				}
			}
		});
//		alert(company);
//		alert(contact);
//		alert(telphone);
//		alert(wechat);
//		alert(positions);
//		alert(remark);
//		alert(isMemmber);
	}
	function clearText(){
			$("#company").val("");
			$("#contact").val("");
			$("#telphone").val("");
			$("#wechat").val("");
			$("#positions").val("");
			$("#remark").val("");
		}
    $(function () {       
		$('#backid').click(function(){
				window.location.href="index.html";
		 });

    });
</script>