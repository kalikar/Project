<?php
namespace Home\Controller;
use Think\Controller;

class ExcelController extends Controller{
	public function index(){
	/*	if(IS_FILE){
			//var_dump($_POST['excel']);die;
			 $ret = upload_file('excel');
			 if($ret['ok']==0){
			 	//echo '1';die;
			 	$this->error($ret['error']);
			// 	//echo '1';die;
			 }elseif($ret['ok']==1){
			 	//echo 'ok';die;
			 	echo '上传成功';
			 }
		}*/
		$this->display();
	}
	public function upl(){
		if(IS_FILE){
			// $db = M();
			// $fields = $db->query("show full fields from excelimport");
   //  		var_dump($fields);die;
			//var_dump($_POST['excel']);die;
			 $ret = upload_file('excel','excelimport');
			 if($ret['ok']==0){
			 	//echo '1';die;
			 	$this->error($ret['error']);
			// 	//echo '1';die;
			 }elseif($ret['ok']==1){
			 	//echo 'ok';die;
			 	echo '上传成功';
			 }
		}
	}
}