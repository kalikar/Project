<?php
#---------------上传文件并插入数据库中
function upload_file($name,$tablename){
    $tmp_file = $_FILES[$name]['tmp_name'];
    $file_types = explode ( ".", $_FILES[$name]['name'] );
    $file_type = $file_types [count ( $file_types ) - 1];
    /*判别是不是.xls文件，判别是不是excel文件*/
    if (strtolower ( $file_type ) != "xls")              
    {
        return array(
            'ok'=>0,
            'error'=>'不是Excel文件，重新上传',
        );
        
     }

    /*设置上传路径*/
     $savePath = './Public/Uploads/excel/';

    /*以时间来命名上传的文件，文件名可自己设定*/
     $str = date ( 'Ymdhis' ); 
     $file_name = $str . "." . $file_type;

     /*是否上传成功*/
     if (! copy ( $tmp_file, $savePath . $file_name )) 
      {
          return array(
            'ok'=>0,
            'error'=>'上传失败',
        );
      }
    $rows = read($savePath.$file_name);
    //var_dump($rows);die;
    $data = array();
    //获得表字段
    $keys = M($tablename)->getDbFields();
    //$fields = M()->query("show full fields from ".$tablename);
    //var_dump($fields);die;
    //把获得到的数据，第一条记录（即字段而不是数据）去掉
    array_shift($rows);
    //var_dump($rows);
    //循环并插入数据
    foreach($rows as $key =>$v){
      //var_dump($v);
      $data = array_combine($keys, $v);
      //$data['id']=null;
      //var_dump($v);die;
      //var_dump($data);
      //判断是否是时间类型,是的话，就标记是excel表第几列
      foreach ($v as $k => $val) {
        if(strpos($val,'/')!==0){
          $pos = $k;
        }
      }
      $data['complete_time'] = strtotime($v["$pos"]);
     // var_dump($data);die;
      $result = M($tablename)->add($data);
      //echo M($tablename)->getLastSql();die;
      if(!$result){
        return array(
          'ok'=>'0',
          'error'=>'导入数据库失败',
        );
      }/*else{
        return array(
          'ok'=>'1',
        );
      }*/
    }
   // die;
}

#------获得excel中的数据-------
    function read($filename){
        Vendor('excel.PHPExcel');
       // require './excel/PHPExcel.php';
        $objPHPExcel = PHPExcel_IOFactory::load($filename);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        return $sheetData;
    }     
/*function uploadOneImage($imageName, $saveDir, $thumb = array())
{
  // 先从php.ini中取出图片尺寸的限制
  $umf = (int)ini_get('upload_max_filesize');
  // 再取出项目中配置的图片尺寸的限制
  $muf = (int)C('MAX_UPLOAD_FILESIZE');
  // 取小的
  $size = min($umf, $muf);
  $rootPath = C('IMAGE_ROOT_PATH');
  $upload = new \Think\Upload(array(
    'rootPath' => './upload/',   // 图片上传的根目录
    'maxSize' => 3145728,     // 图片尺寸限制
    'exts' => array('jpg','gif','png','jpeg'), // 允许上传的图片的类型
    'savePath' => $saveDir.'/',           // 图片保存的二级目录
  ));
  $info = $upload->upload(array("$imageName" => $_FILES[$imageName]));
  if(!$info)
    return array(
      'ok' => 0,
      'error' => $upload->getError(),
    );
  else
  {
    $url = array(); // 所有图片的路径
    $originalImageName = $info[$imageName]['savepath'] . $info[$imageName]['savename'];
    $url[] = $originalImageName;  // 把原图放到数组中
    // 是否生成缩略图
    if($thumb)
    {
      $image = new \Think\Image();
      // 打开原图片
      $image->open($rootPath . $originalImageName);
      foreach ($thumb as $k => $v)
      {
        // 先拼这个缩略图的路径
        $_path = $info[$imageName]['savepath'] . 'thumb_'.$k.'_' . $info[$imageName]['savename'];
        // 生成缩略图
        $image->thumb($v[0], $v[1], $v[2])->save($rootPath . $_path);
        // 把生成的缩略图的路径也放到数组中
        $url[] = $_path;   
      }
    }
    return array(
      'ok' => 1,
      'url' => $url,
    );
  }
}*/