<?php
//include 'Connection.php';
session_start();

 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
/************************ YOUR DATABASE CONNECTION START HERE   ****************************/
error_reporting(0);
define ("DB_HOST", "localhost"); // set database host
define ("DB_USER", "root"); // set database user
define ("DB_PASS",""); // set database password
define ("DB_NAME","aspare"); // set database name

$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

//$databasetable = "YOUR_TABLE";

/************************ YOUR DATABASE CONNECTION END HERE  ****************************/


set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.

$marray = array();
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

$inputFileName = $target_file; 

try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

global $cid;
global $bid;
global $sid;
global $subid;
//$cid=$_SESSION['cid'];
global $tname;
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
$cid=$_SESSION['cid'];
 $bid=$_SESSION['bid'];
 $sid=$_SESSION['sid'];
 $subid=$_SESSION['subid'];
//$cid=$_SESSION['cid'];
 $tname=trim($allDataInSheet[1]["A"]);



//echo 'getHighestColumn() =  [' . $highestColumm . ']<br/>';
//echo 'getHighestRow() =  [' . $highestRow . ']<br/>';

//$k=1;


	//disp($marray,$k);
testanalysis($allDataInSheet,$objPHPExcel);
calcvalue($allDataInSheet,$objPHPExcel,$tnmae);
//getvalue($objPHPExcel);



function calcvalue($allDataInSheet,$objPHPExcel){

	$highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
    $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
	$k=1;
  $h=$highestColumm;
   $t_student=0;

	for($i = 'C'; $i < $h; $i++){
	    
		$q_co = $allDataInSheet[1][$i];

		$max_mark = $allDataInSheet[2][$i];
		$q_no = $k;
		//$no_90s = 30;
		//echo $no_90s;

		$no_90s = $no_80s = $no_70s = $no_60s =$no_40s=0;
		$k++;
		for($j=4; $j < $highestRow; $j++){
			if(is_numeric($allDataInSheet[$j][$i])){
				//$p_val=0;
				$p_val=(($allDataInSheet[$j][$i] ) / $max_mark)*100;
				//echo $p_val;

				if($p_val >= 90){
					$no_90s ++ ; 
					//echo $no_90s;

				}
				elseif ($p_val >= 80) {
					# code...
					$no_80s++;
				}
				elseif ($p_val>= 70) {
					# code...
					$no_70s++;
				}
			elseif ($p_val>= 60) {
					# code...
					$no_60s++;
				}
				elseif($p_val>=40) {
					# code...
					 $no_40s++;
				}


			}

		}
		$marray[$q_no][1] = $q_no;
		$marray[$q_no][2]= $q_co;

		$marray[$q_no][3]= $no_90s;
		$marray[$q_no][4]= $no_80s;
		$marray[$q_no][5]= $no_70s;
		$marray[$q_no][6]= $no_60s;
		$marray[$q_no][7]= $no_40s;

		   $fval=30;
           //$marray[$q_no][8]=$fval;
	}
    
	
	for($i=1;$i<$k;$i++){
 
 	$count=$highestRow-4;
 	
 	//echo $highestRow-3;
          	//$fval=0;
		   $j=3;
           $fval= ((($marray[$i][$j]*5)+($marray[$i][$j+1]*4)+($marray[$i][$j+2]*3)+($marray[$i][$j+3]*2)+($marray[$i][$j+4]*1))/($count*5))*3;
          // $fvalue=round($fval, 1);
       $marray[$i][$j+5]=$fval;}	

    /*    if (preg_match("/TOTAL/i", $allDataInSheet[3][$highestColumm])){
          $cid=$_SESSION['cid'];
 $bid=$_SESSION['bid'];
 $sid=$_SESSION['sid'];
 $subid=$_SESSION['subid'];
//$cid=$_SESSION['cid'];
 $tname=trim($allDataInSheet[1]["A"]);

        mysql_query("insert into testanalysis (cid,bid,sid,subid,testname,t_no_stu,no_abs,no_pre,no_pass,no_fail,per_pass,class_avg) values('$cid','$bid','$sid','$subid','$tname','$t_student','$absent','$pres','$no_pass','$no_fail','$per_pass','$c_avg')") or die(mysql_error());
         }
          */
	//disp($marray,$k);
	finalcalc($marray,$k,$allDataInSheet);
}


function testanalysis($allDataInSheet,$objPHPExcel){

$highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
    $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
  $k=1;
  $h=$highestColumm;
   $t_student=0;

  if (preg_match("/TOTAL/i", $allDataInSheet[3][$highestColumm]))
{
  $h=$highestColumm-1;;
  $high_mark=$allDataInSheet[2][$highestColumm];
  $pass_mark=$high_mark/2;
  $no_fail=0;
  $no_pass=0;
  $c_sum=0;
  $pres=0;
  $absent=0;
  
  // echo $allDataInSheet[1]['A'];
  for($i=4;$i< $highestRow;$i++){
    $t_student++;
    if(is_numeric($allDataInSheet[$i][$highestColumm])){

      if($allDataInSheet[$i][$highestColumm] < $pass_mark){$no_fail++;}else{$no_pass++;}
    $c_sum = $c_sum+$allDataInSheet[$i][$highestColumm];
    $pres++;
  }else{$absent++;}
  }
  $c_avg=($c_sum/$pres);
  $per_pass=($no_pass/$pres)*100;

   $cid=$_SESSION['cid'];
 $bid=$_SESSION['bid'];
 $sid=$_SESSION['sid'];
 $subid=$_SESSION['subid'];
//$cid=$_SESSION['cid'];
 $tname=trim($allDataInSheet[1]["A"]);

        mysql_query("insert into testanalysis (cid,bid,sid,subid,testname,t_no_stu,no_abs,no_pre,no_pass,no_fail,per_pass,class_avg) values('$cid','$bid','$sid','$subid','$tname','$t_student','$absent','$pres','$no_pass','$no_fail','$per_pass','$c_avg')") or die(mysql_error());
  }


}

function finalcalc($marray,$k,$allDataInSheet)
{
    $count_A = $count_B = $count_C= $count_D =$count_E = 0;
    $A_val=$B_val=$C_val=$D_val=$E_val=0;
	for($i=1;$i<$k;$i++){
		     if($marray[$i][2]=='A'){
                    $count_A=$count_A+1;
                    $A_val=($A_val+$marray[$i][8]);
		     }
		     elseif($marray[$i][2]=='B'){
                    $count_B=$count_B+1;
                    $B_val=$B_val+$marray[$i][8];
		     }
		     elseif($marray[$i][2]=='C'){
                    $count_C=$count_C+1;
                    $C_val=$C_val+$marray[$i][8];
		     }
		     elseif($marray[$i][2]=='D'){
                    $count_D=$count_D+1;
                    $D_val=$D_val+$marray[$i][8];
		     }
		     elseif($marray[$i][2]=='E'){
                    $count_E=$count_E+1;
                    $E_val=$E_val+$marray[$i][8];
		     }
       }
      /* $A_val=round($A_val,2);
       $B_val=round($B_val,2);
       $C_val=round($C_val,2);
        $D_val=round($D_val,2);
         $E_val=round($E_val,2);
    /*   $A_val=round($A_val/$count_A);
        $A_val=round($A_val,1);
       $B_val=round($B_val/$count_B);
       $B_val=round($B_val,1);
       $C_val=round($C_val/$count_C);
       $C_val=round($C_val,1);
      $D_val=round($D_val/$count_D);
       $D_val=round($D_val,1);
       $E_val=round($E_val/$count_E);
       $E_val=round($E_val,1);*/
     //  $A_val=$A_val/$count_A;
      // $A_val=round($A_val,1);
      // $B_val=$B_val/$count_B;
      // $B_val=round($B_val,1);
       //$C_val=$C_val/$count_C;
       //$C_val=round($C_val,1);
      // $D_val=$D_val/$count_D;
     //  $D_val=round($D_val,1);
       //$E_val=$E_val/$count_E;
      // $E_val=round($E_val,1);
      
 $cid=$_SESSION['cid'];
 $bid=$_SESSION['bid'];
 $sid=$_SESSION['sid'];
 $subid=$_SESSION['subid'];
//$cid=$_SESSION['cid'];


 $tname=trim($allDataInSheet[1]["A"]);

       mysql_query("insert into testresult (cid,bid,sid,subid,testname,co1,co2,co3,co4,co5,count_co1,count_co2,count_co3,count_co4,count_co5) values('$cid','$bid','$sid','$subid','$tname','$A_val','$B_val','$C_val','$D_val','$E_val','$count_A','$count_B','$count_C','$count_D','$count_E')") or die(mysql_error());
   modtable($count_A, $count_B, $count_C,$count_D ,$count_E,$A_val,$B_val,$C_val,$D_val,$E_val,$A_val,$B_val,$C_val,$D_val,$E_val)  ;  
}

function modtable($count_A, $count_B, $count_C,$count_D ,$count_E,$A_val,$B_val,$C_val,$D_val,$E_val,$A_val,$B_val,$C_val,$D_val,$E_val) 
{
 $c_id=$_SESSION['cid'];
 $b_id=$_SESSION['bid'];
 $s_id=$_SESSION['sid'];
 $sub_id=$_SESSION['subid'];
	//$sql="SELECT cid,bid,sid,subid,no_test,co1,co2,co3,co4,co5 FROM finalresult WHERE subid='$sub_id'";

//echo $sub_id;
$result = mysql_query("SELECT cid,bid,sid,no_test,co1,co2,co3,co4,co5,count1,count2,count3,count4,count5 FROM finalresult WHERE subid='$sub_id'  AND bid='$b_id'");
$n= mysql_num_rows($result);
//echo 
 if ( $n >0 ){
    $row = mysql_fetch_row($result);
  //echo $no_test;
	//if(('$cid'=='$c_id') and ('$bid'=='$b_id') and ('$sid'=='$s_id'))
   //{
   	//$ci_d=$row[0];
   	$bi_d=$row[1];
   //	$si_d=$row[2];
   	$no1_test=$row[3];

   	$co11=$row[4];
   //	echo $co11;
   	$co21=$row[5];
   	$co31=$row[6];
   	$co41=$row[7];
   	$co51=$row[8];
   	$count1=$row[9];
   	$count2=$row[10];
   	$count3=$row[11];
   	$count4=$row[12];
   	$count5=$row[13];
   	//echo $no1_;;test;
   	if($bi_d==$b_id){
   	 $no1_test=$no1_test+1;
   	 $co11=$co11+$A_val;
   	 $co21=$co21+$B_val;
   	 $co31=$co31+$C_val;
   	 $co41=$co41+$D_val;
   	 $co51=$co51+$E_val;
   	 $count1=$count1+$count_A;
   	 $count2=$count2+$count_B;
   	 $count3=$count3+$count_C;
   	 $count4=$count4+$count_D;
   	 $count5=$count5+$count_E;

   	   
   	
   
   	 mysql_query("UPDATE finalresult SET no_test='$no1_test', co1='$co11',co2='$co21',co3='$co31',co4='$co41',co5='$co51',count1='$count1',count2='$count2',count3='$count3',count4='$count4',count5='$count5' where subid='$sub_id'  AND bid='$b_id'") or die(mysql_error());
 
   }
   
    // some data matched
} else {
    // no data matched
                      $no=1;
                   // echo $no;

                    mysql_query("insert into finalresult (cid,bid,sid,subid,no_test,co1,co2,co3,co4,co5,count1,count2,count3,count4,count5) values('$c_id','$b_id','$s_id','$sub_id','$no','$A_val','$B_val','$C_val','$D_val','$E_val','$count_A','$count_B','$count_C','$count_D','$count_E')") or die(mysql_error());
}




  
}

mysql_query("insert into test (cid, bid, sid, subid, testname) values('$cid','$bid','$sid','$subid','$tname')") or die(mysql_error());
 

header("location:viewmarks.php");

?>


<body>
</html>