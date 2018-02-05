<?php 
	include 'Connection.php';
	include 'header.php';
?>

<?php
// Include config file
require_once 'Connection.php';
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $newpassword= $department= "";
$username_err = $password_err = $confirm_password_err = $newpassword_err= $department_err= "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    /*
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }*/
    //role

 //if(empty(trim($_POST["role"]))){
   //     $role_err = "role doest exist";
    //} else{
        // Prepare a select statement
        //$sql = "SELECT id FROM users WHERE username = ?";
        
       // if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
          //  mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
      //   $role = trim($_POST['role']);
           // $param_role = trim($_POST["role"]);
            
            // Attempt to execute the prepared statement
           
         
        // Close statement
        //mysqli_stmt_close($stmt);
    }
//department
// if(empty(trim($_POST["department"]))){
  //      $department_err = "department doest exist";
   // } else{
        // Prepare a select statement
        //$sql = "SELECT id FROM users WHERE username = ?";
        
       // if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
          //  mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
    //     $department = trim($_POST['department']);
           // $param_role = trim($_POST["role"]);
            
            // Attempt to execute the prepared statement
           
         
        // Close statement
        //mysqli_stmt_close($stmt);
    }

//if(empty($username_err)&& empty($password_err) && empty($confirm_password_err)){
    // Check input errors before inserting in database
    if(empty($username_err) ){
      //  $t=password_hash('asd123', PASSWORD_DEFAULT);
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password,role,department) VALUES (?,?,?,?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
           // $param_password='asd123';
           // mysqli_stmt_bind_param($stmt,"ss" ,$param_username, $param_password, $param_role);
               mysqli_stmt_bind_param($stmt, "sss", $param_username,  $param_role, $param_department);
            // Set parameters
            $param_username = $username;
           // $param_password = password_hash('asd123', PASSWORD_DEFAULT); // Creates a password hash
            $param_role = $role;
            $param_department = $department;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: indexm.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 <div class="wrapper">
        <div style="width:50%;margin:0 auto;">
        </br>
        
        <span style="color:red;font-size:20px;">* Please fill this form to create an account.</span><br/>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup><span style="color:red;">*</span></sup></label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($newpassword_err)) ? 'has-error' : ''; ?>">
                <label>new Password:<sup><span style="color:red;">*</span></sup></label>
                <input type="password" name="newpassword" class="form-control" value="<?php echo $newpassword; ?>">
                <span class="help-block"><?php echo $newpassword_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm new Password:<sup><span style="color:red;">*</span></sup></label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
        <!--
          <!-- <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Role:<sup><span style="color:red;">*</span></sup></label>
                <input type="role" name="role" class="form-control" value="<?php echo $role; ?>">
                <span class="help-block"><?php echo $role_err; ?></span>
           <!-- </div>
       </br>
            <label>Department:<sup><span style="color:red;">*</span></sup></label>
                <input type="department" name="department" class="form-control" value="<?php echo $department; ?>">
                <span class="help-block"><?php echo $department_err; ?></span>-->
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            </form>
    </div> 
      </div>   
<!--
<?php 
	//include 'footer.php';
?>
-->