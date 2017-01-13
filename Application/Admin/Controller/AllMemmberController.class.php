<?php
namespace Admin\Controller;
use Think\Controller;
class AllMemmberController extends CommonController {
    public function index(){
        $this-> display();
	}
	public function add(){
		$this -> display(add);
	}
	//根据传递条件查询会员数据
	public function getMemmberData(){
		$keyword= $_REQUEST["keyword"];
		$sql = "CALL search_memmber('$keyword')";
		$res = M() -> query($sql);
		$this -> success($res);
	}
	//
	public function updateMemmberInfo(){
//		UPDATE memmber_base_info SET company='就是现在', contact='eee', position='aaaa', telPhone='214234', wechat='aaa', remarks='78687' WHERE `code` = '1';
//		$sql = "UPDATE memmber_base_info SET company='就是现在', contact='eee', position='aaaa', telPhone='214234', wechat='aaa', remarks='78687' WHERE `code` = '1'";
//data:{"code":code,"company":company,"contact":contact,"telphone":telphone,"wechat":wechat,"positions":positions,"remark":remark,},
//		$model = M();
		$code = $_REQUEST["code"];
		$company = $_REQUEST["company"];
		$contact = $_REQUEST["contact"];
		$position = $_REQUEST["positions"];
		$telphone = $_REQUEST["telphone"];
		$wechat = $_REQUEST["wechat"];
		$remarks = $_REQUEST["remark"];
		$sql = "UPDATE memmber_base_info SET company='$company', contact='$contact', position='$position', telPhone='$telphone', wechat='$wechat', remarks='$remarks' where `code` = '$code'";
		$res = M() -> execute($sql);
		$this -> success($res);
	}
	//新增会员
	public function addMemmber(){
//		$this -> checkRepeatData();
		//插入数据名要与表字段匹配
		$company = $_REQUEST["company"];
		$contact = $_REQUEST["contact"];
		$position = $_REQUEST["position"];
		$telPhone = $_REQUEST["telphone"];
		$wechat = $_REQUEST["wechat"];
		$sign = "0";
		$remarks = $_REQUEST["remarks"];
		$isMemmber;
		if($_REQUEST["isMemmber"] == "是"){
			$isMemmber = "1";
		}else{
			$isMemmber = "0";
		}
		$sql = "INSERT INTO `memmber_base_info`(`company`, `contact`, `position`, `telPhone`, `wechat`, `sign`, `remarks`, `is_szma_memmber`) VALUES ('$company','$contact','$position','$telPhone','$wechat','$sign','$remarks','$isMemmber')";
		$res = M() -> execute($sql);
//		echo $res;
		$this -> success($res);
	}
	//导入
	public function import(){
		$tableName="memmber_base_info";
        $title=array("company","contact","position","telPhone","wechat","sign","remarks","is_szma_memmber","szma_code");
        $result= importExcel($tableName,$title);
        $this->success($result);
	}
}