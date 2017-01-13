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
	    <script type="text/javascript" src="/SignatureSystem/Public/js/jquery.cookie.js"></script>
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
	<body>
		<form class="form-inline definewidth m20" action="index.html" method="get">  
		    机构名称：
		    <input type="text" name="rolename" id="telphoneOrName"class="abc input-default" placeholder="输入手机号码或者姓名" value="">&nbsp;&nbsp;  
		    <input type="button" class="btn btn-primary" value="查询" onclick="searchMemmber()"/>&nbsp;&nbsp; <!--<button type="button" class="btn btn-danger" onclick="history.go(-1)">返回上一页</button>-->
			<input type="button" class="btn btn-primary pull-right" value="添加" onclick="addMemmberForMeeting()"/>
			<input style="margin-right: 20px;" type="button" class="btn btn-default pull-right" value="全选" onclick="allSelect()"/>
			<input style="margin-right: 20px;" type="button" class="btn btn-danger pull-right" value="取消所有选择" onclick="cancelSelect()"/>
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
		        <th>操作</th>
		    	</tr>
	    	</thead>
	    	<tbody id="memmberTbody">
	    		<?php if(is_array($unMeetingMemmberList)): $i = 0; $__LIST__ = $unMeetingMemmberList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			        <td><?php echo ($vo["code"]); ?></td>
			        <td><?php echo ($vo["company"]); ?></td>
			        <td><?php echo ($vo["contact"]); ?></td>
			        <td><?php echo ($vo["position"]); ?></td>
			        <td><?php echo ($vo["telphone"]); ?></td>
			        <td><?php echo ($vo["wechat"]); ?></td>
			        <td><?php echo ($vo["remarks"]); ?></td>
			        <td><input type='checkbox' value=<?php echo ($vo["code"]); ?> name='items'/></td>
			    	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	    	</tbody>

		</table>
	<!--<div class="inline pull-right page">
	         10122 条记录 1/507 页  <a href='#'>下一页</a>     <span class='current'>1</span><a href='#'>2</a><a href='/chinapost/index.php?m=Label&a=index&p=3'>3</a><a href='#'>4</a><a href='#'>5</a>  <a href='#' >下5页</a> <a href='#' >最后一页</a>    
	</div>-->
	<input value=<?php echo ($meetingId); ?> id="meetingID" type="hidden" />
	</body>
</html>
<script>
	function allSelect(){
		var a = document.getElementsByTagName("input");
		for(var i = 0;i<a.length;i++){
				if(a[i].type == "checkbox") a[i].checked = true;
			}
	}
	function cancelSelect(){
		var a = document.getElementsByTagName("input");
		for(var i = 0;i<a.length;i++){
				if(a[i].type == "checkbox") a[i].checked = false;
			}
	}
	function addMemmberForMeeting(){
//		alert($("#meetingID").val());
//		alert($.cookie('meetingId'));
		var ipts = $(":checkbox:checked");
		str = ipts.map(function(){
			return $(this).val();
		}).get().join(",");
		//拆分为字符串
//		alert(str);
//		alert(str[0]);
		$.ajax({
			type:"post",
			url:"/SignatureSystem/Admin/AddMeetingActivities/addMeetingMemmber",
			async:true,
			data:{"memmberArr":str,"meetingID":$("#meetingID").val()},
			success: function (res){
//				alert(res.info);
				if (res.info > 0 ) {
					layer.msg('添加成功');
					ipts.map(function(){
						$(this).attr('checked',false);
						$(this).attr('disabled',true);
						$(this).after('&nbsp;<b  style="color: red;">已添加</b>');
					});
				}
			}
		});
	}
    $(function () {
//  	请求数据
//		$.ajax({
//			type:"post",
//			url:"/SignatureSystem/Admin/AllMemmber/getMemmberData",
//			data:{"type":"0","value":""},
//			async:true,
//			success:function(res){
////				console.log("结果"+res.info[0]["contact"])
////				var i;
////				var html;
////				for (i in res.info){
////					console.log(res.info[i]["contact"])
////					html += "<tr><td>"+res.info[i]['code']+"</td><td>"+res.info[i]['company']+"</td><td>"+res.info[i]['contact']+"</td><td>"+res.info[i]['position']+"</td><td>"+res.info[i]['telphone']+"</td><td>"+res.info[i]['wechat']+"</td><td>"+res.info[i]['remarks']+"</td><td><input type='radio' /></td></tr>";
//////					
////				}
////				$('#memmberTbody').append(html);
//				showMemmber(res);
////				alert(html);
////				alert(res.info)
//			}
//		});
		
        
		$('#addnew').click(function(){

			window.location.href="/SignatureSystem/Admin/AddMeetingActivities/add";
		 });
		 $("#edit").click(function(){
		 	window.location.href = "edit.html";
		 });


    });
    //查找
    function searchMemmber(){
    		var keyword = $("#telphoneOrName").val();
    		var meetingId = $("#meetingID").val();
    		$.ajax({
    			type:"post",
    			url:"/SignatureSystem/Admin/AddMeetingActivities/searchMemmber",
    			data:{"keyword":keyword,"meetingId":meetingId},
    			async:true,
    			success: function (res) {
    				showMemmber(res);
    			}
    		});
//  		alert(keyword+'会议'+meetingId);
    }
	function queryData(){
			var parameters = $("#telphoneOrName").val();
			var type;
			if (/^[0-9]{0,20}$/.test(parameters)) {
					//电话
					type = "1";
				}else{
					//姓名
					type = "2";
				}
			$.ajax({
				type:"post",
				url:"/SignatureSystem/Admin/AddMeetingActivities/getMemmberData",
				data:{"type":type,"value":parameters},
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
				console.log(res.info[i]["contact"])
				html += "<tr><td>"+res.info[i]['code']+"</td><td>"+res.info[i]['company']+"</td><td>"+res.info[i]['contact']+"</td><td>"+res.info[i]['position']+"</td><td>"+res.info[i]['telphone']+"</td><td>"+res.info[i]['wechat']+"</td><td>"+res.info[i]['remarks']+"</td><td><input type='checkbox' /></td></tr>";
//					
			}
			$('#memmberTbody').html(html);
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