<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	    <title></title>
	    <meta charset="UTF-8">
	    <link rel="stylesheet" type="text/css" href="/SignatureSystem/Public/admin/Css/bootstrap.css" />
	    <link rel="stylesheet" type="text/css" href="/SignatureSystem/Public/admin/Css/bootstrap-responsive.css" />
	    <link rel="stylesheet" type="text/css" href="/SignatureSystem/Public/admin/Css/style.css" />
	    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/jquery.js"></script>
	    <!--<script type="text/javascript" src="/SignatureSystem/Public/admin/Js/jquery.sorted.js"></script>-->
	    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/bootstrap.js"></script>
	    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/ckform.js"></script>
	    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/common.js"></script>
	
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
	    <!--<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">-->
	</head>
	<body>
		<!--编辑框begin-->
		<!-- 模态框（Modal） -->
		<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none">
		   <div class="modal-dialog">
		      <div class="modal-content">
		         <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" 
		               aria-hidden="true">×
		            </button>
		            <h4 class="modal-title" id="myModalLabel">
		               编辑信息
		            </h4>
		         </div>
		         <div class="modal-body">
		         	<table class='table table-bordered table-hover definewidth m10'>
					    <!--<tr>
					        <td width='10%' class='tableleft'>机构编号</td>
					        <td><input type='text' name='grouptitle'/></td>
					    </tr>-->
					    <tr>
					        <td class='tableleft'>机构名称<span style='color: red;'>*</span></td>
					        <td><input type='text' name='company' id='company' value='' code=''/></td>
					    </tr>
					    <tr>
					        <td width='10%' class='tableleft'>联系人<span style='color: red;'>*</span></td>
					        <td><input type='text' name='contact' id='contact' value=''/></td>
					    </tr>
					    <tr>
					        <td width='10%' class='tableleft'>联系电话<span style='color: red;'>*</span></td>
					        <td><input type='text' name='telphone' id='telphone' value=''/></td>
					    </tr>
					    <tr>
					        <td class='tableleft'>微信号<span style='color: red;'>*</span></td>
					        <td><input type='text' name='wechat' id='wechat' value=''/></td>
					    </tr>
					    <tr>
					        <td class='tableleft'>职务</td>
					        <td><input type='text' name='position' id='position' value=''/></td>
					    </tr> 
					    <tr>
					        <td class='tableleft'>备注</td>
					        <td><input type='text' name='remark' id='remark' value=''/></td>
					    </tr> 
					    <tr>
					        <td class='tableleft'></td>
					        <td>
					            <button type='submit' class='btn btn-primary' type='button' onclick="updateMemmber()" data-dismiss="modal">保存</button>&nbsp;&nbsp;<!--<button type='button' class='btn btn-success' name='backid' id='backid'>返回列表</button>-->
					        </td>
					    </tr>
					</table>
		         </div>
		         
		      </div><!-- /.modal-content -->
		   </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!--编辑框end-->
		<form class="form-inline definewidth m20">  
		    机构名称：
		    <input type="text" name="rolename" id="search-keyword"class="abc input-default" placeholder="公司名称/手机号码/姓名" value="">&nbsp;&nbsp;  
		    <input type="button" class="btn btn-primary" value="查询" onclick="queryData()"/>&nbsp;&nbsp; <button type="button" class="btn btn-success" id="addnew">新增机构</button> <button type="button" class="btn btn-success pull-right" id="allMemmber" onclick="getAllMemmber()">查看所有</button>
		</form>
		<table class="table table-bordered table-hover definewidth m10" >
		    <thead>
			    <tr>
		        <th>机构编号</th>
		        <th>机构名称</th>
		        <th>联系人</th>
		        <th>职务</th>
		        <th>联系电话</th>
		        <th>微信号</th>
		        <th>备注</th>
		        <th>协会会员</th>
		        <!--<th>操作</th>-->
		    	</tr>
	    	</thead>
	    	<tbody id="memmberTbody">
	    		<!--<tr "></tr>-->
	    	</tbody>

		</table>						
	<!--<div class="inline pull-right page">
	         10122 条记录 1/507 页  <a href='#'>下一页</a>     <span class='current'>1</span><a href='#'>2</a><a href='/chinapost/index.php?m=Label&a=index&p=3'>3</a><a href='#'>4</a><a href='#'>5</a>  <a href='#' >下5页</a> <a href='#' >最后一页</a>    
	</div>-->
	</body>
</html>
<script>
document.onkeydown=function(event){
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if(e && e.keyCode==27){ // 按 Esc 
                //要做的事情
              }
            if(e && e.keyCode==113){ // 按 F2 
                 //要做的事情
               }            
             if(e && e.keyCode==13){ // enter 键
                 //要做的事情
//               queryData();
                 return false;
            }
        }; 
    $(function () {
    	
//  	请求数据
		getAllMemmber();
		
        
		$('#addnew').click(function(){

			window.location.href="/SignatureSystem/Admin/AllMemmber/add";
		 });
		 $("#edit").click(function(){
		 	window.location.href = "edit.html";
		 });


    });
    function getAllMemmber(){
    		$.ajax({
			type:"post",
			url:"/SignatureSystem/Admin/AllMemmber/getMemmberData",
//			data:{"type":"0","value":""},
			async:true,
			success:function(res){
//				console.log("结果"+res.info[0]["contact"])
//				var i;
//				var html;
//				for (i in res.info){
//					console.log(res.info[i]["contact"])
//					html += "<tr><td>"+res.info[i]['code']+"</td><td>"+res.info[i]['company']+"</td><td>"+res.info[i]['contact']+"</td><td>"+res.info[i]['position']+"</td><td>"+res.info[i]['telphone']+"</td><td>"+res.info[i]['wechat']+"</td><td>"+res.info[i]['remarks']+"</td><td><a href='#' id='edit'>编辑</a><a href='#' onclick='del()'>删除</a></td></tr>";
////					
//				}
//				$('#memmberTbody').append(html);
				
				showMemmber(res);
//				alert(html);
//				alert(res.info)
			}
		});
    }
	function queryData(){
			var keyword = $("#search-keyword").val();
			if(keyword.length <= 0){
				alert('请输入查询关键字');
				return;
			}
			$.ajax({
				type:"post",
				url:"/SignatureSystem/Admin/AllMemmber/getMemmberData",
				data:{"keyword":keyword},
				async:true,
				success:function(res){
					showMemmber(res);
				}
			});
		}
    function showMemmber(res){
    			var i;
			var html;
			for (i in res.info){
//				console.log(res.info[i]["contact"])
//				<td><a href='#' id='edit'>编辑</a><a href='#' onclick='del()'>删除</a></td>
//				alert('是不是会员:'+res.info[i]['is_szma_memmber']);
				var isMemmber;
				if (res.info[i]['is_szma_memmber'] == '1') {
					isMemmber = '是';
				} else{
					isMemmber = '否';
				}
				html += "<tr code='"+res.info[i]['code']+"' company='"+res.info[i]['company']+"' contact='"+res.info[i]['contact']+"' wechat='"+res.info[i]['wechat']+"' position='"+res.info[i]['position']+"' telphone='"+res.info[i]['telphone']+"' remarks='"+res.info[i]['remarks']+"' onclick='editMemmber(this)' data-toggle='modal' data-target='#editModal'><td>"+res.info[i]['code']+"</td><td>"+res.info[i]['company']+"</td><td>"+res.info[i]['contact']+"</td><td>"+res.info[i]['position']+"</td><td>"+res.info[i]['telphone']+"</td><td>"+res.info[i]['wechat']+"</td><td>"+res.info[i]['remarks']+"</td><td>"+isMemmber+"</td></tr>";
//					
			}
			$('#memmberTbody').html(html);
    }
    //编辑会员信息框
    function editMemmber(obj){
//  	$("#company").setAttribute("placeholder","hehehehehe");
//  		alert($("#company").attr('placeholder','你猜猜'));
		var code = obj.getAttribute("code");
		var company = obj.getAttribute("company");
		var contact = obj.getAttribute("contact");
		var wechat = obj.getAttribute("wechat");
		var positions = obj.getAttribute("position");
		var remarks = obj.getAttribute("remarks");
		var telphone = obj.getAttribute("telphone");
		$("#company").attr('value',company);
		$("#company").attr('code',code);
		$("#contact").attr('value',contact);
		$("#wechat").attr('value',wechat);
		$("#position").attr('value',positions);
		$("#remark").attr('value',remarks);
		$("#telphone").attr('value',telphone);
    }
    //修改保存会员信息
    function updateMemmber(){
    		var code = $("#company").attr("code");
    		var company = $("#company").val();
    		var contact = $("#contact").val();
    		var telphone = $("#telphone").val();
    		var wechat = $("#wechat").val();
    		var positions = $("#position").val();
    		var remark = $("#remark").val();
//  		alert(code);
    		$.ajax({
    			type:"post",
    			url:"/SignatureSystem/Admin/AllMemmber/updateMemmberInfo",
    			async:true,
    			data:{"code":code,"company":company,"contact":contact,"telphone":telphone,"wechat":wechat,"positions":positions,"remark":remark,},
    			success:function (res) {
    				if (res.info == "1"){
    					getAllMemmber();
    					alert("保存成功");
    				}else{
    					alert("保存失败");
    				}
    			}
    		});
//  		alert(company);
    }
	function del(id)
	{
		
		
		if(confirm("确定要删除吗？"))
		{
		
			var url = "index.html";
			
			window.location.href=url;		
		
		}
	
	
	
	
	}
</script>