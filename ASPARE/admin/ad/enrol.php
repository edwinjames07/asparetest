<?php

include 'Connection.php';
//$uname=$_POST['uname'];
//$data = array('Firstname', 'LastName','email','Designation');
if($_SERVER["REQUEST_METHOD"] == "POST"){

$user=$_POST['user'];           
 $dep=$_POST['dep'];
 $sub=$_POST['sub'];
 $batch=$_POST['batch'];
 
// $Header = array('A', 'A','B','B');
 $arrlength = count($sub);
 //echo $arrlength;
 //echo "<br>";
for($x = 0; $x < $arrlength; $x++) {
   /* echo $user;
 echo "<br>";
 echo $dep;
 echo "<br>";
    echo $sub[$x];
     echo $batch[$x];
    echo "<br>";*/
    $sql='INSERT INTO enrol(uid,cid,subid,bid)
                VALUES("'.$user.'","'. $dep.'","'. $sub[$x].'","'. $batch[$x].'")';

}

        if (mysqli_query($conn, $sql)) {
            header('Location: indexm.php'); 
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
         mysqli_close($conn);
}

?>