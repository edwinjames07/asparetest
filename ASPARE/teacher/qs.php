<?php

//$test=$_POST['test'];
/*$name2=$_POST['lname'];
$email=$_POST['email'];
$des=$_POST['des'];
*/
$data=$_POST['BX_QNO'];
//$data = array('Firstname', 'LastName','email','Designation');
$BX_MARK=$_POST['BX_MARK'];           
 $Header=$_POST['BX_CO'];
// $Header = array('A', 'A','B','B');
$arrlength = count($data);
$arr = count($Header);
$tst=$_POST['test'];
$total=$_POST['tot'];
/*
for($x = 0; $x < $arrlength; $x++) {
    echo $data[$x];
    echo "<br>";
}
*/
//echo "<br>";
/*
for($x = 0; $x < $arr; $x++) {
    echo $Header[$x];
    echo "<br>";
}*/
//echo $BX_QNO;
//The Header Row

//$Header = array('A', 'A','B','B');
//$Header= array('Firstname', 'LastName','email','Designation');
//$data = array('1A', '1B','2A','2B');
//$BX_MARK = array('Firstname', 'LastName','email','Designation');
//$data = array();

//Data to be written in the excel sheet -- Sample Data
//array_push($data, array($name1 ,$name2,$email,$des));

$filename = write_excel1($data, $Header, $BX_MARK, $tst, $total);


function write_excel1($data, $Header, $BX_MARK, $tst, $total)
{
    set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
/** PHPExcel */
include 'PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'PHPExcel/Writer/Excel2007.php';
    //We are using PHPExcel Library for creating the Microsoft Excel file
    //require_once  './PHPExcel/Classes/PHPExcel.php';

    $objPHPExcel = new PHPExcel();
    //Activate the First Excel Sheet
    $ActiveSheet = $objPHPExcel->setActiveSheetIndex(0);
    $ActiveSheet->SetCellValue('A1', $tst);
    $ActiveSheet->SetCellValue('A3', 'Roll No');
    $ActiveSheet->SetCellValue('B3', 'Student Name');
    $ActiveSheet->SetCellValue('B1', 'COURSE OUTCOME');
    //$ActiveSheet->getColumnDimension('B1')->setAutoSize(true); 
    $ActiveSheet->SetCellValue('B2', 'MAX MARK');

        //Write the Header

    $i=2;
    foreach($Header as $ind_el)
       // for($x = 0; $x < $arrlength; $x++) {
    {
        //Convert index to Excel compatible Location
        $Location = PHPExcel_Cell::stringFromColumnIndex($i) . '1';
        $ActiveSheet->setCellValue($Location,$ind_el );
        $i++;
    }

       $i=2;
    foreach($BX_MARK as $ind_el)
       // for($x = 0; $x < $arrlength; $x++) {
    {
        //Convert index to Excel compatible Location
        $Location = PHPExcel_Cell::stringFromColumnIndex($i) . '2';
        $ActiveSheet->setCellValue($Location,$ind_el );
        $i++;
    }
    $Location = PHPExcel_Cell::stringFromColumnIndex($i) . '2';
    $ActiveSheet->setCellValue($Location,$total );
   


    //this piece of code use to add rows in excel sheet.
    //Insert that data from Row 2, Column A (index 0)
   // $rowIndex=3;
    // echo $rowIndex;
    $columnIndex=2; //Column A
   // foreach($data as $row)
   // {           
        foreach($data as $ind_el)
          //  for($x = 0; $x < $arr; $x++) {
        {       

            $Location = PHPExcel_Cell::stringFromColumnIndex($columnIndex) . '3';
            //var_dump($Location);
            $ActiveSheet->setCellValue($Location,$ind_el );     //Insert the Data at the specific cell specified by $Location
            $columnIndex++;
        }

            $Location = PHPExcel_Cell::stringFromColumnIndex($columnIndex) . '3';
            $ActiveSheet->setCellValue($Location,'Total' ); 

       // $rowIndex++;

   // }       
/*     
/*
    //1. Mark the Header Row  in Color Red
    $Range = 'A1:B1:C1:D1';
    $color = 'FFFF0000';
    $ActiveSheet->getStyle($Range)->getFill($Range)->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($color);

    //2. Set the Column Width

    for($i=0; $i<count($Header);$i++)
    {
        $Location = PHPExcel_Cell::stringFromColumnIndex($i) ;
        $ActiveSheet->getColumnDimension($Location)->setAutoSize(true); 
    }
    */

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="template.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

  //  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    //Result File name
   // $objPHPExcel = PHPExcel_IOFactory::load("myfile.xlsx");

  //  $objWriter->save('myfile.xlsx');

}

?>