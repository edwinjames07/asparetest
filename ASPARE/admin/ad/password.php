<?php
// Include config file
require_once 'connection.php';
 
// Define variables and initialize with empty values
$username = $password =$role= $department=$newpassword=$cpassword="";
$username_err = $password_err =$role_err = $newpassword_err=$cpassword_err= $hashed_newpassword="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }

    if(empty(trim($_POST['newpassword']))){
        $newpassword_err = 'Please enter new password.';
    } else{
        $newpassword = trim($_POST['newpassword']);
    }

    if(empty(trim($_POST['cpassword']))){
        $cpassword_err = 'Please reenter your password.';
    } else{
        $cpassword = trim($_POST['cpassword']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password,role,department FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
           // mysqli_stmt_bind_param($stmt, "s", $param_username);
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            $param_role=$role;
            $param_department=$department;
            $param_password=$password;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password,$role,$department);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){



            // Set parameters
            $param_username = $username;
            $param_newpassword = password_hash($newpassword, PASSWORD_DEFAULT); // Creates a password hash
            $param_role = $role;
            $param_department = $department;


                           //   $hashed_newpassword= password_hash($newpassword, PASSWORD_DEFAULT);
                            if(($cpassword== $newpassword))
                          {
                                 $sqli = "UPDATE users SET password='$param_newpassword' where username='$username'";
                                 

                                 if ($conn->query($sqli) === TRUE) {
                                      // echo "Record updated successfully";

                                        header("location: indexm.php");

                                        } else {
                                     echo "Error updating record: " . $conn->error;
                                        }


                          }
                          else{
                            $cpassword_err='The two passwords didnt match';
                          }
                            /* Password is correct, so start a new session and
                            save the username to the session */
                           // session_start();
                           // $_SESSION['username'] = $username;     
                           //  $_SESSION['role'] = $role; 
                           //  $_SESSION['department'] = $department;
                           //  $_SESSION['password'] = $password;
                           
                            
                           // $hashed_cpassword=

                             ///if($role=="admin")
                               //header("location:admin/ad/indexm.php");
                            //if($role=="teacher")
                              //  header("location:teacher/index.php");   
                           // header("location: welcome.php");
                            //if($role=="hod")
                              // header("location:coming-soon.html");
                            //if($role=="student")
                             //header("location:coming-soon.html");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }

                          
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/lightbox.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 overflow">
                   <div class="social-icons pull-right">
                        <ul class="nav nav-pills">
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                            <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
             </div>
        </div>
        <div class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="indexm.php">
                        <h1><img src="images/logo.png" alt="logo"></h1>
                    </br>
                    </a>

                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li ><a href="index.php">Home</a></li>

                        <li class="active"><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
                <div class="search">
                    <form role="form">
                        <i class="fa fa-search"></i>
                        <div class="field-toggle">
                            <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!--/#header-->

   
    <!--/#home-slider-->
    
    
              <div class="container">
               <div id="feature-container">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                 <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                      <label>Username:<sup>*</sup></label>
                     <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
             <div class="form-group <?php echo (!empty($newpassword_err)) ? 'has-error' : ''; ?>">
                <label>New Password:<sup>*</sup></label>
                <input type="password" name="newpassword" class="form-control">
                <span class="help-block"><?php echo $newpassword_err; ?></span>
            </div>
              <div class="form-group <?php echo (!empty($cpassword_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password:<sup>*</sup></label>
                <input type="password" name="cpassword" class="form-control">
                <span class="help-block"><?php echo $cpassword_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <!--<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>-->
        </form>
              </div>


     <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center bottom-separator">
                    <img src="images/home/under.png" class="img-responsive inline" alt="">h
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="testimonial bottom" style="width:300px;height:500px;">
                        <h2>Get the Best From Us</h2>
                        <div class="media">
                            <div class="pull-left">

                            </div>
                            <div class="media-body">
                                <blockquote>Fell free to contact us for any assistance.</blockquote>
                                <h3><a href="#">- 9605403492</a></h3>
                            </div>
                         </div>
                        <div class="media">
                          <!--  <div class="pull-left">

                            </div>-->
                            <div class="media-body">
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="contact-info bottom">
                        <h2>Contacts</h2>
                        <address>
                        E-mail: <a href="mailto:edwinjames07@gmail.com">edwinjames07@gmail.com</a> <br>
                        Phone: +91 9605403492<br>
                        </address>

                        <h2>Address</h2>
                        <address>
                        ASIET <br>
                        CS S7, <br>
                        Kalady <br>
                        India <br>
                        </address>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="contact-form bottom">
                        <h2>Send a message</h2>
                        <form id="main-contact-form" name="contact-form" method="post" action="sendemail.php">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" required="required" placeholder="Email Id">
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your text here"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="copyright-text text-center">
                        <p>&copy; RARE Creations 2017. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/lightbox.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>   
</body>
</html>
