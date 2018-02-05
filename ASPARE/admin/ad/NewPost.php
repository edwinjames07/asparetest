
<?php
include 'Connection.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(("" == trim($_POST['name1'])) || ("" == trim($_POST['name2']))) {
        echo "<script>
        		alert('Please fill all the fields');
        	  </script>";
    }    

    else {
        $yr=" ";
    	$pdate = date('Y-m-d H:i:s A');
    	echo "$date";
   
    
      //  $yr = $_POST['name1'] ."-". $_POST['name2'];
     
    	$sql='INSERT INTO batch(batch, date)
    			VALUES("'. $_POST['name1'] ."-". $_POST['name2'] .'","'. $pdate.'")';

		if (mysqli_query($conn, $sql)) {
		    header('Location: indexm.php'); 
		} 
		else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}


    }
    mysqli_close($conn);
}
?>
<?php 
	
	include 'header.php';
?>



 <div class="wrapper">
        <div style="width:50%;margin:0 auto;">
        </br>
        
        <span style="color:red;font-size:20px;">* Please fill this form to add a new batch</span><br/>
    </br>
        
        <form  id='newpost' name='newpost' method="post" action="#">
            <div class="form-group" >
                <label>Starting Year:<sup><span style="color:red;">*</span></sup></label>
                <td><input type='text' name='name1' id='name1' /></td>
            
                <label>End Year:<sup><span style="color:red;">*</span></sup></label>
                <td><input type='text' name='name2' id='name2' /></td>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            
    </div> 
      </div>
      </form> 
      </div>  


<?php 
	include 'footer.php';
?>