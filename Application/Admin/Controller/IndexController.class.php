<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this-> display();
	}
	public function verify_c(){  
	    $Verify = new \Think\Verify();  
	    $Verify->fontSize = 18;  
	    $Verify->length   = 4;  
	    $Verify->useNoise = false;  
	    $Verify->codeSet = '0123456789';  
	    $Verify->imageW = 130;  
	    $Verify->imageH = 50;  
	    //$Verify->expire = 600;  
	    $Verify->entry();  
	}
	public function login(){
		//直接提交表单可用此方法获取填写的验证码
//		$verify = I('param.verify','');  
		//ajax提交
		$verify = $_REQUEST["verify"];
		if(!$this -> check_verify($verify)){  
			$this->error("亲，验证码输错了哦！");
			return;
		}
		$model = M("user");
		$account = $_REQUEST["account"];
		$condition["Username"] = $account;
		$res = $model -> where($condition) -> select();
		if(!(count($res) > 0)){
			$this->error("不存在该用户");
			return;
		}
		$pwd = md5($_REQUEST["pwd"]);
		$condition["Password"] = $pwd;
		$res = $model -> where($condition) -> select();
		if(!(count($res) > 0)){
			$this->error("密码错误");
			return;
		}else{
			//登陆缓存跳转
			$_SESSION["AutoLoginUser"]["account"] = $account;
			$_SESSION["AutoLoginUser"]["pwd"] = $pwd;
			$this -> success("ok");
		}
	}
	public function check_verify($code, $id = ""){  
	    $verify = new \Think\Verify();  
	    return $verify->check($code, $id);  
	} 
	public function check($code, $id = '') {  
        $key = $this->authcode($this->seKey).$id;  
        // 验证码不能为空  
        $secode = session($key);  
        if(empty($code) || empty($secode)) {  
            return false;  
        }  
        // session 过期  
        if(NOW_TIME - $secode['verify_time'] > $this->expire) {  
            session($key, null);  
            return false;  
        }  
  
        if($this->authcode(strtoupper($code)) == $secode['verify_code']) {  
            $this->reset && session($key, null);//这里验证后被置空  
            return true;  
        }  
  
        return false;  
    } 
}