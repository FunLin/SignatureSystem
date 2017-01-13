<?php
namespace Admin\Controller;
use Think\Controller;
class AddMeetingActivitiesController extends CommonController {
    public function index(){
        $this-> display();
	}
	public function addMemmber(){
		//获取的是cookie中的meetingId
		$meetingId = $_REQUEST['meetingId'];
		//1.通过meetingId先从meeting_memmber里查已存在人员
		$sql1 = "SELECT mm.memmber_id FROM meeting_memmber mm WHERE mm.meeting_id = '$meetingId';";
		$res1 = M() -> query($sql1);
		//2.获取所有人员，将已经存在的移除,0519存在bug。
		$res2 = $this -> getMemmberData();
//		print_r($res2);
//		$res2Count = count($res2);
		$arr;
		for ($i=0; $i <count($res1) ; $i++) { 
			for($j=0; $j<count($res2); $j++){
				if($res1[$i]['memmber_id'] == $res2[$j]["code"]){
					array_splice($res2,$j,1);
				}
			}
		}
		$this -> assign("unMeetingMemmberList",$res2);
		$this -> assign("meetingId",$meetingId);
		$this -> display('selectMemmber');
	}
	//创建活动
	public function createMeeting(){
		$meetingName = $_REQUEST["meetingName"];
		$address = $_REQUEST["address"];
		$beginTime = $_REQUEST["beginTime"];
		$endTime = $_REQUEST["endTime"];
		$remark = $_REQUEST["remark"];
		$sql = "INSERT INTO meeting_activities (name,address,time_begin,time_end,remarks) VALUES ('$meetingName','$address','$beginTime','$endTime','$remark');";
		$res = M() -> execute($sql);
		$id = M('meeting_activities') -> getLastInsID();
		$this -> success($id);
	}
	public function getMemmberData(){
		$sql = "CALL search_memmber('')";
		$res = M() -> query($sql);
		return $res;
	}
	//添加与会人员
	public function addMeetingMemmber(){
		$memmberStr = $_REQUEST['memmberArr'];
		$meetingID = $_REQUEST['meetingID'];
		$memmberArr = explode( ',',$memmberStr);
		$model = M('meeting_memmber');
		for ($i=0; $i < count($memmberArr); $i++) { 
			$dataList[] = array('meeting_id'=>$meetingID,'memmber_id'=>$memmberArr[$i],'sign'=>'0','remarks'=>'','seat'=>'');
		}
		$res = $model -> addAll($dataList);
//		INSERT INTO meeting_memmber (meeting_id,memmber_id,sign,remarks,seat) VALUES ('1','11','1','是水','xx桌xx号');
		$this -> success($res);
	}
	public function searchMemmber(){
		$keyword = $_REQUEST['keyword'];
		$meetingId = $_REQUEST['meetingId'];
		$sql2 = "CALL search_memmber('$keyword')";
		$res2 = M() -> query($sql2);
		//1.通过meetingId先从meeting_memmber里查已存在人员
		$sql1 = "SELECT mm.memmber_id FROM meeting_memmber mm WHERE mm.meeting_id = '$meetingId';";
		$res1 = M() -> query($sql1);
		$arr;
		for ($i=0; $i <count($res1) ; $i++) { 
			for($j=0; $j<count($res2); $j++){
				if($res1[$i]['memmber_id'] == $res2[$j]["code"]){
					array_splice($res2,$j,1);
				}
			}
		}
		$this -> success($res2);
	}
}









