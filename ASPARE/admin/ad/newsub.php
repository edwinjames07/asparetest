<?php 
	include 'Connection.php';
	include 'header.php';
?>

<?php
// Include config file
require_once 'Connection.php';
 
// Define variables and initialize with empty values
$course = $semester = $subject = $subjectcode= "";
$subjectcode_err = $subject_err=  "";
 
    // Validate username
    


if($_SERVER["REQUEST_METHOD"] == "POST"){
   //if(isset($_POST['submit'])) {

    if(empty(trim($_POST["subject"]))){
        $subject_err = "Please enter a subject.";
    }
     else{
         $subject = trim($_POST['subject']);
    }
 //Validate password
    if(empty(trim($_POST['subjectcode']))){
        $password_err = "Please enter a subjectcode.";     
    } 
    else{
        $subjectcode = trim($_POST['subjectcode']);
    }
  
    {
       
        
        $sql='INSERT INTO subject(cid,sid,code,subject)
                VALUES("'.$_POST['course'].'","'.$_POST['semester'].'","'.$_POST['subjectcode'].'","'.$_POST['subject'].'")';

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




 <div class="wrapper">
        <div style="width:50%;margin:0 auto;">
        </br>
        
        <span style="color:red;font-size:20px;">* Please fill this form to add a new subject</span><br/>
    </br>
    <table>
        
        <form  id='newpost' name='newpost' method="post" action="#">
           <tr> <div class="form-group" >
              <td><label>course:<sup><span style="color:red;">*</span></sup></label></td>
               <td> <select name="course">
             <option value="1">CS</option>
             <option value="2">IT</option>
             <option value="3">EC</option>
             <option value="4">EEE</option>
             <option value="5">AI</option>
             <option value="6">ME</option>
             <option value="7">CE</option>
             
                </select>
            </div></td></tr></tr><tr><tr>
            <div class="form-group" >
              <td>  <label>semester:<sup><span style="color:red;">*</span></sup></label></td>
             <td>   <select name="semester">
             <option value="1">semester-1</option>
             <option value="2">semester-2</option>
             <option value="3">semester-3</option>
             <option value="4">semester-4</option>
             <option value="5">semester-5</option>
             <option value="6">semester-6</option>
             <option value="7">semester-7</option>
             <option value="8">semester-8</option>
                </select></td>
                
            </div>
             </tr></tr><tr>
             <tr>
            <div class="form-group" >
                <td><label>subject code:<sup><span style="color:red;">*</span></sup></label></td>
                <td><input type='text' name='subjectcode' id='subjectcode' /></td>
            </div></tr></tr><tr><tr>
            <div class="form-group" >
                <td><label>subject:<sup><span style="color:red;">*</span></sup></label></td>
                <td><input type='text' name='subject' id='subject' /></td>
            </div>  

             </tr></tr><tr>

            <tr>
            <div class="form-group">
               <td> <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset"></td>
            </div>
            </tr>
    </div> 
      </div>
      </form>
      </table> 
      </div>  
<!--
 <div class="wrapper">
        <div style="width:50%;margin:0 auto;">
        </br>
        
        <span style="color:red;font-size:20px;">* Please fill this form to create an account.</span><br/>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>U:<sup><span style="color:red;">*</span></sup></label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup><span style="color:red;">*</span></sup></label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password:<sup><span style="color:red;">*</span></sup></label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
        -->
          <!-- <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Role:<sup><span style="color:red;">*</span></sup></label>
                <input type="role" name="role" class="form-control" value="<?php echo $role; ?>">
                <span class="help-block"><?php echo $role_err; ?></span>
            </div>
       </br>
            <label>Department:<sup><span style="color:red;">*</span></sup></label>
                <input type="department" name="department" class="form-control" value="<?php echo $department; ?>">
                <span class="help-block"><?php echo $department_err; ?></span>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            </form>
    </div> 
      </div>  --> 

<?php 
	include 'footer.php';
?>