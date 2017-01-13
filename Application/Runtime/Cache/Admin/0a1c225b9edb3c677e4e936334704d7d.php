<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/SignatureSystem/Public/admin/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/SignatureSystem/Public/admin/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/SignatureSystem/Public/admin/Css/style.css" />
    <!--日期选择器begin-->
    <!--<link href="//cdn.bootcss.com/bootstrap-daterangepicker/2.1.19/daterangepicker.css" rel="stylesheet">
    	<script src="//cdn.bootcss.com/bootstrap-daterangepicker/2.1.19/daterangepicker.js"></script>
    	<link href="//cdn.bootcss.com/bootstrap-daterangepicker/2.1.19/daterangepicker.min.css" rel="stylesheet">
    	<script src="//cdn.bootcss.com/bootstrap-daterangepicker/2.1.19/daterangepicker.min.js"></script>
    	<script src="//cdn.bootcss.com/bootstrap-daterangepicker/2.1.19/moment.js"></script>
    	<script src="//cdn.bootcss.com/bootstrap-daterangepicker/2.1.19/moment.min.js"></script>-->
    	<!--日期选择器end-->
    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/jquery.js"></script>
    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/ckform.js"></script>
    <script type="text/javascript" src="/SignatureSystem/Public/admin/Js/common.js"></script>
    <script src="http://libs.baidu.com/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="/SignatureSystem/Public/js/jquery.date_input.pack.js"></script>
    <script type="text/javascript" src="/SignatureSystem/Public/js/jquery.cookie.js"></script>
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
    <style type="text/css"> 
*{ margin:0; padding:0;}
body { font:12px/1.5 Arial; color:#666; background:#fff;}
ul,li{ list-style:none;}
img{border:0 none;}
/*---------------------------------------demo css--------------------------------------------*/
.date_selector, .date_selector *{width: auto;height: auto;border: none;background: none;margin: 0;padding: 0;text-align: left;text-decoration: none;}
.date_selector{background:#fbfbfb;border: 1px solid #ccc;padding: 10px;margin:0;margin-top:-1px;position: absolute;z-index:100000;display:none;border-radius: 3px;box-shadow: 0 0 5px #aaa;box-shadow:0 2px 2px #ccc; width:220px;}
.date_selector_ieframe{position: absolute;z-index: 99999;display: none;}
.date_selector .nav{width: 17.5em;}
.date_selector .nav p{clear: none;}
.date_selector .month_nav, .date_selector .year_nav{margin: 0 0 3px 0;padding: 0;display: block;position: relative;text-align: center;}
.date_selector .month_nav{float: left;width: 55%;}
.date_selector .year_nav{float: right;width: 42%;margin-right: -8px;}
.date_selector .month_name, .date_selector .year_name{font-weight: bold;line-height: 20px;}
.date_selector .button{display: block;position: absolute;top: 0;width:18px;height:18px;line-height:16px;font-weight:bold;color:#5985c7;text-align: center;font-size:12px;overflow:hidden;border: 1px solid #ccc;border-radius:2px;}
.date_selector .button:hover, .date_selector .button.hover{background:#5985c7;color: #fff;cursor: pointer;border-color:#3a930d;}
.date_selector .prev{left: 0;}
.date_selector .next{right: 0;}
.date_selector table{border-spacing: 0;border-collapse: collapse;clear: both;margin: 0; width:220px;}
.date_selector th, .date_selector td{width: 2.5em;height: 2em;padding: 0 !important;text-align: center !important;color: #666;font-weight: normal;}
.date_selector th{font-size: 12px;}
.date_selector td{border:1px solid #f1f1f1;line-height: 2em;text-align: center;white-space: nowrap;color:#5985c7;background: #fff;}
.date_selector td.today{background: #eee;}
.date_selector td.unselected_month{color: #ccc;}
.date_selector td.selectable_day{cursor: pointer;}
.date_selector td.selected{background:#2b579a;color: #fff;font-weight: bold;}
.date_selector td.selectable_day:hover, .date_selector td.selectable_day.hover{background:#5985c7;color: #fff;}
/*-----------------------------------------------------------------------------------*/
</style> 

    <script type="text/javascript" src="/SignatureSystem/Public/layer/layer.min.js"></script>
</head>
<script type="text/javascript">
$(function(){
	$('.date_picker_begin').date_input();
	$('.date_picker_end').date_input();
	})
</script>
<form>
<table class="table table-bordered table-hover definewidth m10">
    <!--<tr>
        <td width="10%" class="tableleft">机构编号</td>
        <td><input type="text" name="grouptitle"/></td>
    </tr>-->
    <tr>
        <td class="tableleft">活动名称<span style="color: red;">*</span></td>
        <td>
        		<input type="text" name="grouptitle" id="meetingName"/>
        </td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">地点<span style="color: red;">*</span></td>
        <td><input type="text" name="grouptitle" id="address"/></td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">开始时间<span style="color: red;">*</span></td>
        <td><!--<input type="text" name="grouptitle" id="beginTime"/>-->
        		<input type="text" class="date_picker_begin" id="beginTime">
        </td>
    </tr>
    <tr>
        <td class="tableleft">结束时间</td>
        <td><input type="text" class="date_picker_end" id="endTime"/></td>
    </tr>
    <!--<tr>
        <td class="tableleft">职务</td>
        <td><input type="text" name="moduletitle"/></td>
    </tr> -->
    <tr>
        <td class="tableleft">备注</td>
        <td><input type="text" name="moduletitle" id="remark"/></td>
    </tr> 
    <!--<tr>
        <td class="tableleft">状态</td>
        <td>
            <input type="radio" name="status" value="1" checked/> 启用
            <input type="radio" name="status" value="0"/> 禁用
        </td>
    </tr>-->
    <tr>
        <td class="tableleft"></td>
        <td>
            <button class="btn btn-primary" type="button" onclick="createMeeting()">创建活动</button>
        </td>
    </tr>
</table>
</form>
</body>
</html>
<script>
    $(function () {

    });
    //创建活动
    function createMeeting(){
    		var meetingName = $("#meetingName").val();
    		var address = $("#address").val();
    		var beginTime = $("#beginTime").val();
    		var endTime = $("#endTime").val();
    		var remark = $("#remark").val();
    		if(!meetingName){
				alert("活动名不能为空");
				return;
			}
		if(!address){
			alert("地点不能为空");
			return;
		}
		if(!beginTime){
			alert("开始时间不能为空");
			return;
		}
    		$.ajax({
    			type:"post",
    			url:"/SignatureSystem/Admin/AddMeetingActivities/createMeeting",
    			async:true,
    			data:{"meetingName":meetingName,"address":address,"beginTime":beginTime,"endTime":endTime,"remark":remark},
    			success:function (res) {
    				$.cookie('meetingId',res.info);
//  				alert(res.info);
    				if(res.info != 0){
    					layer.msg("创建成功",1);
    					setTimeout(function(){
    						//u方法，将活动id传过去
    						window.location.href="/SignatureSystem/Admin/AddMeetingActivities/addMemmber";
    					}, 1000);
    				}
//  				alert("创建活动"+res.info);
    			}
    		});
    }
</script>