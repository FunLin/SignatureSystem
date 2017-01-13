<?php
namespace Admin\Controller;
use Think\Controller;
class MeetingActivitiesController extends CommonController {
    public function index(){
        $this-> display();
	}
	public function add(){
		$this -> display(add);
	}
	public function meetingList(){
		$model = M("meeting_activities");
		$res = $model -> select();
		$this -> success($res);
	}
	//获取活动下会员id
	public function meetingMemmberIDArr(){
		$condition["meeting_id"] = $_REQUEST["meetingID"];
		$res = M("meeting_memmber") ->where($condition) -> select();
		$infoArr;
		for($i = 0;$i < count($res); $i ++){
			$infoArr[$i] = $this -> singleMemmberInfo($res[$i]["memmber_id"]);
			if($res[$i]["sign"] == "1"){
				$infoArr[$i]["signText"] = "已到";
				$infoArr[$i]["signButton"] = "还未到?";
				$infoArr[$i]["buttonState"] = "btn btn-warning";
			}else{
				$infoArr[$i]["signText"] = "未到";
				$infoArr[$i]["signButton"] = "签到";
				$infoArr[$i]["buttonState"] = "btn btn-primary";
			}
			$infoArr[$i]["remarks"] = $res[$i]["remarks"];
			$infoArr[$i]["seat"] = $res[$i]["seat"];
		}
		$this -> success($infoArr);
	}
	//根据id查询会员信息
	public function singleMemmberInfo($id){
		$model = M("memmber_base_info");
		$condition["code"] = $id;
		$res = $model -> where($condition) -> select();
		return $res[0];
	}
	//签到
	public function updateSign(){
		$model = M("meeting_memmber");
		$condition["memmber_id"] = $_REQUEST["memmberId"];
		$condition["meeting_id"] = $_REQUEST["meetingId"];
		$data["sign"] = 0;
		if($_REQUEST["sign"] == "签到"){
			$data["sign"] = 1;
		}
		$res = $model -> where($condition) -> save($data);
		$this -> success($res);
	}
	//关键字查询
	public function queryMemmber(){
//		SELECT * FROM memmber_base_info WHERE company LIKE '%009%' OR contact LIKE '%009%' OR telPhone LIKE '%150%'
		$keyWord = $_REQUEST["keyWord"];
		$meetingId = $_REQUEST["meetingId"];
		$sql = "call memmberList_keyword($meetingId,'$keyWord')";
		$res = M() -> query($sql);
//		$sql2 = "select * from meeting_memmber where meeting_id =$meetingId";
//		$signRes = M() -> query($sql2);
		for($i = 0; $i < count($res); $i ++){
			if($res[$i]["sign"] == "1"){
				$res[$i]["signText"] = "已到";
				$res[$i]["signButton"] = "还未到?";
				$res[$i]["buttonState"] = "btn btn-warning";
			}else{
				$res[$i]["signText"] = "未到";
				$res[$i]["signButton"] = "签到";
				$res[$i]["buttonState"] = "btn btn-primary";
			}
		}
		$this -> success($res);
	}
	//未到已到查询
	public function isArrivedMemmber(){
//		SELECT * FROM memmber_base_info WHERE company LIKE '%009%' OR contact LIKE '%009%' OR telPhone LIKE '%150%'
		$type = $_REQUEST["type"];
		$meetingId = $_REQUEST["meetingId"];
		$sql = "call memmber_in_meeting($meetingId,$type)";
		$res = M() -> query($sql);
		
		for($i = 0; $i < count($res); $i ++){
			if($res[$i]["sign"] == "1"){
				$res[$i]["signText"] = "已到";
				$res[$i]["signButton"] = "还未到?";
				$res[$i]["buttonState"] = "btn btn-warning";
			}else{
				$res[$i]["signText"] = "未到";
				$res[$i]["signButton"] = "签到";
				$res[$i]["buttonState"] = "btn btn-primary";
			}
		}
		$this -> success($res);
	}
	//更新坐席和备注
	function updateSeatAndRemark() {
		$meetingId = $_REQUEST["meetingId"];
		$memmberId = $_REQUEST["memmberId"];
		$seat = $_REQUEST["seat"];
		$remark = $_REQUEST["remark"];
		$sql = "UPDATE meeting_memmber mm SET mm.seat='$seat',mm.remarks='$remark' WHERE mm.meeting_id='$meetingId' AND mm.memmber_id='$memmberId';";
		$res = M() -> execute($sql);
		$this -> success($res);
	}
	//总人数、已到人数、未到人数、百分比
	function percentMemmber(){
		$meetingId = $_REQUEST["meetingId"];
		//总人数
		$sql1 = "SELECT COUNT(*) FROM meeting_memmber WHERE meeting_id='$meetingId';";
		$res1 = M() -> query($sql1);
		$total = $res1[0]["count(*)"];
		//未到人数
		$sql2 = "SELECT COUNT(*) FROM meeting_memmber WHERE meeting_id='$meetingId' AND sign='0';";
		$res2 =  M() -> query($sql2);
		$nonArrived = $res2[0]["count(*)"];
		//已到人数
		$arrived = $total - $nonArrived;
		//已到百分比
		$percent = ceil(($arrived/$total) * 100);
		$sData["total"] = $total;
		$sData["nonArrived"] = $nonArrived;
		$sData["arrived"] = $arrived;
		$sData["percent"] = $percent;
		$this -> success($sData);
	}
	/**
     * 导出
     */
    public function export(){
        $condition["meeting_id"] = $_REQUEST["meetingId"];
        $subject= $_REQUEST["meetingName"];
//		$subject= "导出测试";
		$res = M("meeting_memmber") ->where($condition) -> select();
		$infoArr;
		for($i = 0;$i < count($res); $i ++){
			$infoArr[$i] = $this -> singleMemmberInfo($res[$i]["memmber_id"]);
			if($res[$i]["sign"] == "1"){
				$infoArr[$i]["sign"] = "已到";
//				$infoArr[$i]["signButton"] = "还未到?";
//				$infoArr[$i]["buttonState"] = "btn btn-warning";
			}else{
				$infoArr[$i]["sign"] = "未到";
//				$infoArr[$i]["signButton"] = "签到";
//				$infoArr[$i]["buttonState"] = "btn btn-primary";
			}
			$infoArr[$i]["remarks"] = $res[$i]["remarks"];
			$infoArr[$i]["seat"] = $res[$i]["seat"];
		}
        $title=array("company","contact","position","telPhone","wechat","sign","remarks","is_szma_memmber","szma_code");
        exportExcel($infoArr,$title,$subject); 
//  		$this -> success('导出');
    }
}









