<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
//      var_dump("构造函数");
//		R('Index/index',array('删除失败'));
		
//		if(!isset($_SESSION["AutoLoginUser"])){
//			$this->redirect('Index/index');
//		}
        if(isset($_SESSION["AutoLoginUser"])){
//      	$this->redirect(__MODULE__/Main);
//      	var_dump("存在");
        }else{
//      	var_dump("bu存在");
//			A('Home/Index') -> index();
			$this->success('请登录',__MODULE__,0.01);
//			$this ->redirect(__APP__.'/Index/index');
        }
//		var_dump(isset($_SESSION["AutoLoginUser"]));
	}
}