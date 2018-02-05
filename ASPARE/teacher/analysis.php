<?php
session_start();
$name=$_GET['test'];

 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
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
    <link href="css/lightbox.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
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
<style type="text/css">

caption { 


    display: table-caption;
    text-align: center;
}
</style>
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
        <!--
        <?php
        echo "course";
      echo   $_SESSION['cid'];
      
      echo "\nbatch";
      echo   $_SESSION['bid'];
      
      echo "\nsemester";
      echo $_SESSION['sid'];
            echo "\nsubject";
      echo $_SESSION['subid'];
      
        ?>
    -->
        <div class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="dashboard.php">
                        <h1><img src="images/logo.png" alt="logo"></h1>
                    </a>

                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php">Home</a></li>
                       <!-- <li><a href="password.php">change password</a></li>-->
                        <li><a href="logout.php ">Logout</a></li>
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
<?php

//include 'Connection.php';


require_once 'Connection.php';


        // Prepare a select statement
        $sql ="SELECT t_no_stu,no_abs,no_pre,no_pass,no_fail,per_pass,class_avg FROM  testanalysis WHERE testname ='$name' ";
        $result = $conn->query($sql);
        //$m= mysql_num_rows($msql);
      echo  '<center> <h2>test Analysis  </h2></center>';
      //  <caption> $name </caption>class=" table-bordered"
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc( )) {
echo '<table class=" table-bordered" align="center" border="1">
  
  <tr>
    <th>Tottal no of students</th><td> '.$row["t_no_stu"].'</td>
    </tr>
    <tr>
  <th>No of stdents absent</th><td>'. $row["no_abs"].'</td>
  </tr>
  <tr>
  <th>No of students appeared</th><td>'. $row["no_pre"].'</td>
  </tr>
  <tr>  <th>No of students passed</th><td>'. $row["no_pass"].'</td>
  </tr>
  <tr>
  <th>No of students failed</th><td>'. $row["no_fail"].'</td></tr>
  <tr><th>Percentage of passed</th><td>'. $row["per_pass"].'</td></tr>
 <tr><th>Class average</th><td>'. $row["class_avg"].'</td></tr> ';
       //while($row = $result->fetch_assoc( )) {
       
    //echo "<tr><td>" . $row["t_no_stu"]. "</td><td>" . $row["no_abs"]. "</td><td>" . $row["no_pre"]. "</td><td>" . $row["no_pass"]. "</td><td>" . $row["no_fail"]. "</td><td>" . $row["per_pass"]. "</td><td>" . $row["class_avg"]. "</td></tr>";
              
                
}                  
 echo '</table>';                 
}
    else {
    echo "0 results";               
}


             
    
?>

    

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