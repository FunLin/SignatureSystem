<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
    <title>后台管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/LFCMS/Public/admin/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="/LFCMS/Public/admin/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="/LFCMS/Public/admin/assets/css/main-min.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="header">

    <div class="dl-title">
        <!--<img src="/chinapost/Public//LFCMS/Public/admin/assets/img/top.png">-->
    </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo ($account); ?></span><a href="/chinapost/index.php?m=Public&a=logout" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
</div>
<div class="content">
    <div class="dl-main-nav">
        <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
        <ul id="J_Nav"  class="nav-list ks-clear">
        	<!--//nav-home,nav-order类名样式加icon-->
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">会员管理</div></li>		
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">活动管理</div></li>
			<li class="nav-item dl-selected"><div class="nav-item-inner nav-order">企业大数据</div></li>
        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">
			
    </ul>
</div>
<script type="text/javascript" src="/LFCMS/Public/admin/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/LFCMS/Public/admin/assets/js/bui-min.js"></script>
<script type="text/javascript" src="/LFCMS/Public/admin/assets/js/common/main-min.js"></script>
<script type="text/javascript" src="/LFCMS/Public/admin/assets/js/config-min.js"></script>
<script>
    BUI.use('common/main',function(){
        var config = [{id:'1',menu:[{text:'会员管理',items:[{id:'2',text:'所有会员',href:'/LFCMS/Admin/AllMemmber'},{id:'3',text:'角色管理',href:'Role/index.html'},{id:'4',text:'用户管理',href:'User/index.html'},{id:'6',text:'菜单管理',href:'Menu/index.html'}]}]},{id:'2',menu:[{text:'活动管理',items:[{id:'2',text:'活动签到',href:'/LFCMS/Admin/MeetingActivities'},{id:'3',text:'新建活动',href:'Role/index.html'},{id:'4',text:'用户管理',href:'User/index.html'},{id:'6',text:'菜单管理',href:'Menu/index.html'}]}]},{id:'7',homePage : '9',menu:[{text:'企业大数据',items:[{id:'9',text:'查询业务',href:'Node/index.html'}]}]}];
        new PageUtil.MainPage({
            modulesConfig : config
        });
    });
</script>
</body>
</html>