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
	        
	        .vcenter {
	        		display: flex;
	        		flex-direction: row;
	        		justify-content: flex-start;
	        		align-items: center;
	        }
	    </style>
	    
	    <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <!--<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>-->
	</head>
	<body>
		<form role="form" style="margin-top: 10px;">
			<div class="form-group vcenter">
					选择活动：
				<select class="selectpicker" id="meetingList" onchange="changeOption(this)">
					<!--<option>Mustard</option>
					<option>Ketchup</option>
					<option emoney='eeee'>Relish</option>-->
				</select>
			    <input type="text" style="margin-bottom: 0px;" name="rolename" id="rolename"class="abc input-default" placeholder="请输入公司名/手机号/姓名" value="">&nbsp;&nbsp;  
			    <button type="button" class="btn btn-primary" onclick="queryMemmber()">查询</button>&nbsp;&nbsp; <a type="button" class="btn btn-success" href="AddMeetingActivities/addMemmber" id="addnew">新增与会人员</a>
			</div>
			
			<div class="form-group">
				<label class="control-label pull-left"><span style="color: darkorange;" id="unSign"><label id="nonArrived"></label>人未到</span>/共<label id="total"></label>人</label>
				<div class="progress">
				    <div id="progress" class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
				       <span style="color: white;"><label id="arrived"></label>人已到(<label id="percent"></label>%)</span>
				    </div>
				</div>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-danger pull-right" style="margin-left: 10px; margin-bottom: 10px;" onclick="isArrivedMemmber(1)">已到人员</button><button type="button" class="btn btn-default pull-right" onclick="isArrivedMemmber(0)">未到人员</button>
			</div>
		</form>
		<form method="post" id="exportForm" action="#" enctype="multipart/form-data">
		   <button type="button" class="btn btn-default pull-right" style="margin-right: 20px;" onclick='exportMeeting()'>导出</button>
		</form>
		<!--<button type="button" class="btn btn-default pull-right" style="margin-right: 20px;" onclick="exportMeeting()">导出</button>-->
		<table class="table table-bordered table-hover definewidth m10" >
		    <thead>
			    <tr>
		        <th>机构编号</th>
		        <th>机构名称</th>
		        <th>联系人</th>
		        <th>职务</th>
		        <th>联系电话</th>
		        <th>微信号</th>
		        <th>坐席</th>
		        <th>备注</th>
		        <th>协会会员</th>
		        <th>操作</th>
		    	</tr>
	    	</thead>
		    <!--<tr>
	            <td>szma025</td>
	            <td>深圳机械行业协会</td>
	            <td>林放</td>
	            <td>iOS工程师</td>
	            <td>1501656666666</td>
	            <td>homeboy002</td>
	            <td>Web全栈</td>
	            <td>
	                  <input type="button" class="btn btn-primary" onclick="" id="" value="签到"/>
	            </td>
	      	</tr>-->
	      	<tbody id="memmberTbody"></tbody>
		</table>						
	<!--<div class="inline pull-right page">
	         10122 条记录 1/507 页  <a href='#'>下一页</a>     <span class='current'>1</span><a href='#'>2</a><a href='/chinapost/index.php?m=Label&a=index&p=3'>3</a><a href='#'>4</a><a href='#'>5</a>  <a href='#' >下5页</a> <a href='#' >最后一页</a>    
	</div>-->
	</body>
</html>
<script>
    $(function () {
    	//获取活动列表数据
		    	$.ajax({
		    		type:"get",
		    		url:"/SignatureSystem/Admin/MeetingActivities/meetingList",
		    		async:true,
		    		success: function (res){
		    			var meetingList = $("#meetingList");
		    			var html;
		    			for (var i in res.info ){
		    				html += "<option meetingName="+res.info[i]["name"]+" meetingId='"+res.info[i]["id"] +"'>"+res.info[i]["name"] + res.info[i]["time_begin"]+"</option>";
		//  				alert(res.info[i]["name"]);
		    			}
		    			meetingList.html(html);
		    			showMeetingMemmber(res.info[0]["id"]);
		    			setAddNewHref(res.info[0]["id"]);
		    			percentMemmber(res.info[0]["id"]);
		    		}
		    	});
    });
    function percentMemmber(meetingID){
   	 	var nonArrived = $("#nonArrived");
   	 	var total = $("#total");
   	 	var arrived = $("#arrived");
   	 	var percent = $("#percent");
   	 	var progress = $("#progress");
// 	 	alert(nonArrived.html());
    		$.ajax({
    			type:"post",
    			url:"/SignatureSystem/Admin/MeetingActivities/percentMemmber",
    			async:true,
    			data:{"meetingId":meetingID},
    			success: function (res){
    				nonArrived.html(res.info['nonArrived']);
    				total.html(res.info['total']);
    				arrived.html(res.info['arrived']);
    				percent.html(res.info['percent']);
    				progress.css("width",res.info['percent']+'%');
//  				nonArrived.innerText = res.info['nonArrived'];
//  				console.log(res.info);
//  				alert('这是统计'+nonArrived);
    			}
    		});
//  		alert(meetingID);
    }
	function changeOption(obj){
//		alert($("#meetingList").find("option:selected").attr("meetingId"));
		showMeetingMemmber($("#meetingList").find("option:selected").attr("meetingId"));
		setAddNewHref($("#meetingList").find("option:selected").attr("meetingId"));
		percentMemmber($("#meetingList").find("option:selected").attr("meetingId"));
//		updateMemmberList($("#meetingList").find("option:selected").attr("memmber"));
	}
	
	//改变新增与会人员的href属性，将meetingid传过去－－改：设置href，参数转换不了，直接存cookie。
	function setAddNewHref(meetingId){
//		alert(meetingId);
		$.cookie('meetingId',meetingId);
//		alert($.cookie('meetingId'));
//		alert(document.cookie);
	}
	//获取所有参会人员详细数据
	function showMeetingMemmber(id){
//		alert('请求前'+id);
//		alert(memmber);
		$.ajax({
			type:"post",
			url:"/SignatureSystem/Admin/MeetingActivities/meetingMemmberIDArr",
			async:true,
			data:{"meetingID":id},
			success: function(res){
//				console.log(res.info);
//				alert("id的哈哈"+res.info);
				if(res.info == null){
					$('#memmberTbody').html('');
//					alert('没有');
				}else{
//					alert('数组个数'+res.info.length);
				}
				updateMemmberList(res);
//				console.log(res.info[0]["company"]);
//				alert(res.info[0]["company"]);
			}
		});
	}
	function updateMemmberList(res){
    		var i;
			var html;
			for (i in res.info){
//				console.log(res.info[i]["contact"])
				var isMemmber;
				if (res.info[i]['is_szma_memmber'] == '1') {
					isMemmber = '是';
				} else{
					isMemmber = '否';
				}
				html += "<tr><td>"+res.info[i]['code']+"</td><td>"+res.info[i]['company']+"</td><td>"+res.info[i]['contact']+"</td><td>"+res.info[i]['position']+"</td><td>"+res.info[i]['telphone']+"</td><td>"+res.info[i]['wechat']+"</td><td code='"+res.info[i]['code']+"' onclick='editSeat(this)'>"+res.info[i]['seat']+"</td><td code='"+res.info[i]['code']+"' onclick='editSeat(this)'>"+res.info[i]['remarks']+"</td><td>"+isMemmber+"</td><td><input memmberId='"+res.info[i]['code']+"' type='button' onclick='signClick(this)' class='"+res.info[i]['buttonState']+"' value='"+res.info[i]['signButton']+"' /></td></tr>";
//					
			}
			$('#memmberTbody').html(html);
    }
	//编辑坐席等
	function editSeat(obj){
		var code = obj.getAttribute("code");
		layer.confirm('坐席：<input type="text" id="seatEdit" /></br>备注：<input type="text" id="remarkEdit" />',function(){
			var meetingId = $("#meetingList").find("option:selected").attr("meetingId");
			var seatValue = $("#seatEdit").val();
			var remarkValue = $("#remarkEdit").val();
			$.ajax({
				type:"post",
				url:"/SignatureSystem/Admin/MeetingActivities/updateSeatAndRemark",
				data:{"meetingId":meetingId,"seat":seatValue,"remark":remarkValue,"memmberId":code},
				async:true,
				success: function(res){
					if (res.info == '1') {
						layer.msg('保存成功',1);
						isArrivedMemmber("0");
					}else{
						layer.msg('保存失败',1);
					}
				}
			});
//			layer.msg('备注'+remarkValue+'会议'+meetingId+'坐席'+seatValue+'会员'+code);
		});
	}
	function signClick(obj){
		var meetingId = $("#meetingList").find("option:selected").attr("meetingId");
		var memmberId = obj.getAttribute("memmberId");
//		alert('会议'+meetingId);
//		alert('会员'+memmberId);
		var btnClass;
		var btnVal;
		if(obj.value == "签到"){
			btnClass = "btn btn-warning";
			btnVal = "还未到?";
		}else{
			btnClass = "btn btn-primary";
			btnVal = "签到";
		}
		$.ajax({
			type:"post",
			url:"/SignatureSystem/Admin/MeetingActivities/updateSign",
			async:true,
			data:{"memmberId":memmberId,"meetingId":meetingId,"sign":obj.value},
			success:function(res){
//				alert(res.info);
				if(res.info == "1"){
//					alert("操作成功");
					obj.setAttribute("value",btnVal);
					obj.setAttribute("class",btnClass);
					percentMemmber(meetingId);
				}else{
					alert("操作失败，请刷新试试");
				}
			}
		});
	}
	function queryMemmber(){
//		alert($("#rolename").val());
		var meetingId = $("#meetingList").find("option:selected").attr("meetingId");
		$.ajax({
			type:"post",
			url:"/SignatureSystem/Admin/MeetingActivities/queryMemmber",
			async:true,
			data:{"meetingId":meetingId,"keyWord":$("#rolename").val()},
			success:function(res){
				updateMemmberList(res);
//				console.log(res.info);
//				alert(res.info);
			}
		});
	}
	//未到已到
	function isArrivedMemmber(type){
//		alert($("#rolename").val());
		var meetingId = $("#meetingList").find("option:selected").attr("meetingId");
//		alert(type);
//		alert(meetingId);
		$.ajax({
			type:"post",
			url:"/SignatureSystem/Admin/MeetingActivities/isArrivedMemmber",
			async:true,
			data:{"meetingId":meetingId,"type":type},
			success:function(res){
				updateMemmberList(res);
//				console.log(res.info);
//				alert(res.info);
			}
		});
	}
	function del(id)
	{
		
		
		if(confirm("确定要删除吗？"))
		{
		
			var url = "index.html";
			
			window.location.href=url;		
		
		}
	
	
	
	}
	//导出
	function exportMeeting(){
		var meetingId = $("#meetingList").find("option:selected").attr("meetingId");
		var meetingName = $("#meetingList").find("option:selected").attr("meetingName");
		var form = document.getElementById("exportForm");
		var urlF = "<?php echo U('index.php/Admin/MeetingActivities/export/meetingId/"+meetingId+"/meetingName/"+meetingName+"');?>";
//		alert(form.getAttribute('action'));
		form.setAttribute('action',urlF);
//		alert(urlF);
		form.submit();
//		alert(form.getAttribute('action'));
	}
</script>