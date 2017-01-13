<?php
/**
 * 打印数据，用于调试
 * @param var 打印对象
 */
function p($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";

}

/** 
 * author:10xjzheng
 * Excel导入
 * @param title 导入表格的字段
 * @param tableName 导入表格的名字
 * @param savePath 文件保存的路径，默认在Public/Excel/
 */
function importExcel($tableName,$title,$savePath="Public/Excel/")
{   
    import('ORG.Util.ExcelToArrary');//导入excelToArray类
    $tmp_file = $_FILES ['excel'] ['tmp_name'];
    $file_types = explode ( ".", $_FILES ['excel'] ['name'] );
    $file_type = $file_types [count ( $file_types ) - 1];
     /*判别是不是.xls文件，判别是不是excel文件*/
    if (strtolower ( $file_type ) != "xlsx" && strtolower ( $file_type ) != "xls")              
    {
        $rs='不是Excel文件，重新上传';
        return $rs;
    }
    //检查是否有该文件夹，如果没有就创建，并给予最高权限 
    if(!file_exists($savePath)) 
    { 
        mkdir($savePath, 0700); 
    }//END IF

    /*以时间来命名上传的文件*/
    $str = date ( 'Ymdhis' ); 
    $file_name = $str . "." . $file_type;
    /*是否上传成功*/
    if (! copy ( $tmp_file, $savePath . $file_name )) 
    {
         $rs= '上传失败';
         return $rs;
    }
    $ExcelToArrary=new ExcelToArrary();//实例化
    $res=$ExcelToArrary->read($savePath.$file_name,"UTF-8",$file_type);//传参,判断office2007还是office2003
    foreach ( $res as $k => $v ) //循环excel表
    {
        if($k>1){
        $k=$k-2;//addAll方法要求数组必须有0索引
        for ($i=0; $title[$i]; $i++) { 
            $data[$k][$title[$i]] = $v [$i];//创建二维数组 
        }

        }
    }
    $model=M($tableName);//M方法
    $result=$model->addAll($data);
    if(! $result)
    {
         $rs='导入数据库失败';
    }
    else
    {
         $rs= '导入成功';    
    }
    return $rs;
}

/**
 * Excel导出
 * @param data 导出数据
 * @param title 表格的字段名 字段长度有限制，一般都够用，可以改变 $length1和$length2来增长
 * @return subject 表格主题 命名为主题+导出日期
 */
function exportExcel($data,$title,$subject){  
    Vendor('phpexcel.PHPExcel');
    Vendor('phpexcel.PHPExcel.IOFactory');
    Vendor('phpexcel.PHPExcel.Reader.Excel5');
    // Create new PHPExcel object  
    $objPHPExcel = new PHPExcel();  
    // Set properties  
    $objPHPExcel->getProperties()->setCreator("ctos")  
        ->setLastModifiedBy("ctos")  
        ->setTitle("Office 2007 XLSX Test Document")  
        ->setSubject("Office 2007 XLSX Test Document")  
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")  
        ->setKeywords("office 2007 openxml php")  
        ->setCategory("Test result file");  
    $length1=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD');
    $length2=array('A1','B1','C1','D1','E1','F1','G1','H1','I1','J1','K1','L1','M1','N1','O1','P1','Q1','R1','S1','T1','U1','V1','W1','X1','Y1','Z1','AA1','AB1','AC1','AD1');
    //set width  
    for($a=0;$a<count($title);$a++){
         $objPHPExcel->getActiveSheet()->getColumnDimension($length1[$a])->setWidth(20); 
    }
    //set font size bold  
    $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);  
    $objPHPExcel->getActiveSheet()->getStyle($length2[0].':'.$length2[count($title)-1])->getFont()->setBold(true); 
    $objPHPExcel->getActiveSheet()->getStyle($length2[0].':'.$length2[count($title)-1])->getFont()->setBold(true);    
    $objPHPExcel->getActiveSheet()->getStyle($length2[0].':'.$length2[count($title)-1])->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
    
    // set table header content  
    for($a=0;$a<count($title);$a++){
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue($length2[$a], $title[$a]); 
    }
    for($i=0;$i<count($data);$i++){ 
        $buffer=$data[$i];
        $number=0;
        foreach ($buffer as $value) {
            $objPHPExcel->getActiveSheet(0)->setCellValueExplicit($length1[$number].($i+2),$value,PHPExcel_Cell_DataType::TYPE_STRING);//设置单元格为文本格式
            $number++;
        }
        unset($value);
        $objPHPExcel->getActiveSheet()->getStyle($length1[0].($i+2).':'.$length1[$number-1].($i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
        $objPHPExcel->getActiveSheet()->getStyle($length1[0].($i+2).':'.$length1[$number-1].($i+2))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
        $objPHPExcel->getActiveSheet()->getRowDimension($i+2)->setRowHeight(16);  
    }  
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet  
    $objPHPExcel->setActiveSheetIndex(0);  

    ob_end_clean();//清除缓冲区,避免乱码
    // Redirect output to a client’s web browser (Excel5)  
    header('Content-Type: application/vnd.ms-excel');  
    header('Content-Disposition: attachment;filename='.$subject.'('.date('Y-m-d').').xls');  
    header('Cache-Control: max-age=0');  

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
    $objWriter->save('php://output');  
}  
