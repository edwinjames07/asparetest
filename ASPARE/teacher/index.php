<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
<?php
include 'connection.php';

$sql = "SELECT * FROM course order by cid ";
$result = mysqli_query($conn, $sql);


mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>aspare</title>
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
                    </a>

                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li ><a href="indexm.php">Home</a></li>
                        <li><a href="password.php">change password</a></li>
                         <li ><a href="logout.php">logout(<?php echo $_SESSION['username']; ?>)</a></li>
                         <!--
                        <li ><?php echo $_SESSION['username']; ?></li>
-->
                        
                    </ul>
                </div>
               
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!--/#header-->



<div class="warpper">
      <div style="width:55%;margin:12px auto;">
        <h2><center><span style="font-size:24px;">COURSES</span></center></h2>
        </br>

        <?php
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $cid=$row["cid"];
                echo '<table style="font-family:"Times New Roman", Times, serif;font-size:20px;">
                        <tr>
                            <td><a href="batch.php ? cd='.$cid.'" ><h3>'.$row["course"].'</h3>

                            
                            </td>
                        </tr>
                        
                      </table>';
            }
        } 
        ?><!--<?php $temp = 2; ?>
            <table style="font-family: "Times New Roman", Times, serif;font-size:20px;">
                <tr>
                     <button onclick="batch.php"> '.$row["course"].'</button>;
                    <td><a href="batch.php" ><h3>Computer Science</h3></a></td>
                   <a href="batch.php" ><h3>'.$row["course"].'</h3>
                     
                </tr>
                <tr>
                    <td><a href="coming-soon.html" value="2"<?php $temp = 2; ?>><h3>Information Technology</h3></a></td>
                    
                </tr>
                <tr>
                    <td><a href="coming-soon.html"<?php $temp = 3; ?>><h3>Electrical and Electronics Engineering</h3></a></td>
                    
                </tr>
                <tr>
                    <td><a href="coming-soon.html"><h3>Applied Electronics Instrumentation</h3></a></span></td>
                  
                </tr>
                 <tr>
                    <td><a href="coming-soon.html"><h3>Mechanical Engineering</h3></a></span></td>
                   
                </tr>
                 <tr>
                    <td><a href="coming-soon.html"><h3>Civil Engineering</h3></a></span></td>
                    
                </tr>
                <tr>
                   
                
                </tr>
            </table>

            <?php echo $temp; ?>
       -->
    </div>
 </div> 


    <!--/#home-slider-->
    
	
              


     <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center bottom-separator">
                    <img src="images/home/under.png" class="img-responsive inline" alt="">
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
