<?php
// Initialize the session
session_start();
//$sId=$_GET['sd'];
//$_SESSION['sid']=$sId;
//$cid=$_SESSION['cid'];
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
<?php
include 'Connection.php';
//$_SESSION['sid']=$sId;
$bid=$_SESSION['bid'];
$subid=$_SESSION['subid'];
$sql = "SELECT * FROM finalresult WHERE bid= '$bid' AND subid='$subid'";
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

                    <a class="navbar-brand" href="index.php">
                    	<h1><img src="images/logo.png" alt="logo"></h1>
                    </a>

                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li ><a href="index.php">Home</a></li>
                         <li ><a href="logout.php">logout(<?php echo $_SESSION['username']; ?>)</a></li>
                        <li ></li>

                        
                    </ul>
                </div>
               
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!--/#header-->

   <div style="width:35%;margin:0 auto;">
       <center> <h5>CO  Attainment </h5></center>
    </br>
        <?php
      //echo $_SESSION['cid'];
      //echo $_SESSION['bid'];
      //echo $_SESSION['sid'];

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                // $subid=$row["subid"];
                // $sub=$row["subject"];
                //$A_val=round($A_val,2);
                $s1=round($row["co1"]/$row["count1"],2);
                $s2=round($row["co2"]/$row["count2"],2);
                $s3=round($row["co3"]/$row["count3"],2);
                $s4=round($row["co4"]/$row["count4"],2);
                $s5=round($row["co5"]/$row["count5"],2);
                echo '<table  class="table table-bordered" align="center"  >
                        <tr>
                           <th><center>CO1:</th> </center><th><center><h6>'.$s1.'</h6></center></th>
                        </tr>
                         <tr>
                           <th><center>CO2:</th>  </center><th><center><h6>'.$s2.'</h6></center></th>
                        </tr>
                         <tr>
                           <th><center>CO3: </th>  </center><th><center><h6>'.$s3.'</h6></center></th>
                        </tr>
                         <tr>
                           <th><center>CO4:</th>  </center><th><center><h6>'.$s4.'</h6></center></th>
                        </tr>
                         <tr>
                           <th><center>CO5:</th> </center> <th><center><h6>'.$s5.'</h6></center></th>
                        </tr>
                        
                      </table>';
            }
        } else {
    echo "<h6>NO DATA....!</h6>";
        }
        ?> 
      </div>
    <!--/#home-slider-->
    
	
      <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center bottom-separator">
                    <img src="images/home/under.png" class="img-responsive inline" alt="">
                </div>
                
            </div>
        </div>         


     
    <!--/#footer-->

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/lightbox.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>   
</body>
</html>
