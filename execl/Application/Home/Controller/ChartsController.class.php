<?php 
namespace Home\Controller;
use Think\Controller;
class ChartsController extends Controller{
	public function show(){
	/*	$types = M('Charts')->field("distinct month")->select();
		$data= array();
		foreach($types as $v){
			foreach ($v as  $val) {
				$data[] = $val;
			}
			
		}
		echo json_encode($data);
		//$types = array_values($types);
		//var_dump($data);die;
		//$this->display();
		$list = M('Charts')->field('name,data')->order('month asc')->select();
		//echo M('Charts')->getLastSql();
		$ls = array();
		//var_dump($list);
		foreach($list as $key=>$val){
			//if($val['name']=='B'){

				$ls[$val['name']][] = $val['data'];
				//var_dump($val['data']);
			//}
		}
		//var_dump($ls);
		$ll = array();
		foreach($ls as $k => $v){
			$ll[$k]['name']=$k;
			$ll[$k]['data'] =$v;
		}
		var_dump($ll);
		echo json_encode($ll);
		die;*/
		//var_dump($list);die;
		$this->display();
	}

	public  function ajaxCategory(){
		$types = M('Charts')->field("distinct month")->select();
		$data= array();
		foreach($types as $v){
			foreach ($v as  $val) {
				$data[] = $val;
			}
		}
		echo json_encode($data);
	}
	public function ajaxSeries(){
		$list = M('Charts')->field('name,data')->order('month asc')->select();
		//echo M('Charts')->getLastSql();
		$ls = array();
		//var_dump($list);
		foreach($list as $key=>$val){

				$ls[$val['name']][] = $val['data'];
				//var_dump($val['data']);
			//}
		}
		//var_dump($ls);
		$ll = array();
		foreach($ls as $k => $v){
			$ll[$k]['name']=$k;
			$ll[$k]['data'] =$v;
		}
		//var_dump($ll);
		echo json_encode($ll);
	}
}
?>