<?php
namespace Admin\Controller;
use Think\Controller;
class MainController extends CommonController {
    public function index(){
    	$this -> assign("account",$_SESSION["AutoLoginUser"]["account"]);
        $this-> display();
	}
}