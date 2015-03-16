<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        //
        $model = M('Card');
        $rows = $model->field('CardNo')->select();
        echo '<pre>';
        var_dump($rows);die;
        //$this->view();
    }
}