<?php
include 'databaseconfig.php';
// include 'script.php';
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["username"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Time Monitor System</title>

  <link rel="stylesheet" href="Resources/Bootstrap/css/bootstrap.css">
  <script type="text/javascript" src="Resources/jquery.js"></script>
  <link rel="stylesheet" href="jeav.css">
  <script type="text/javascript" src="Resources/Bootstrap/js/bootstrap.js"></script>
  <!-- <link rel="icon" type="image" href="Resources/Images/jeav.ico"> -->
  <style>
  body {
    font-family: Arial, Helvetica, sans-serif;
  }

  .flip-card {
    background-color: transparent;
    width: 300px;
    height: 355px;
    margin: auto;
    float: left;
    padding: inherit;
    perspective: 1000px;
  }

  .flip-card-inner {
    position: relative;
    width: 100%;
    /* float: left; */
    height: 100%;
    text-align: center;
    transition: transform 0.8s;
    transform-style: preserve-3d;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  }

  .flip-card:hover .flip-card-inner {
    transform: rotateY(180deg);
  }

  .flip-card-front, .flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }

  .flip-card-front {
    background-color: #efefc7;
    color: black;
  }

  .flip-card-back {
    background-color: #b5933c;
    color: white;
    transform: rotateY(180deg);
  }
  </style>
</head>
  <body>
<div class="container-fluid">
  <nav class="navbar navbar-default">
  <div class="container-fluid">
  <div class="navbar-header">
   <a class="navbar-brand" href="#">
     <img src="Resources/Images/jeav.png" alt="" height="35" width="35">
   </a>
  </div>
  <ul class="nav navbar-nav">
   <li class="active"><a href="active.php"><span class="glyphicon glyphicon-time"></span> Activity</a></li>
   <li><a href="station.php"> <span class="glyphicon glyphicon-edit"></span> Stations</a></li>
   <li><a href="adminpanel.php"> <span class="glyphicon glyphicon-list"></span> Admin Panel</a></li>
   <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
  </ul>
  <ul class="nav navbar-nav navbar-right">
    <li>Welcome:<strong> <?php echo $_SESSION['username']; ?></strong> <span class="glyphicon glyphicon-user"></span></li>
    <li> <a href="logout.php">
            Logout <span class="glyphicon glyphicon-log-out"></span></a> </li> </ul>
  </div>
  </nav>
<div class="row">
  <div class="col-lg-1 cok-sm-1 col-md-1">
<!-- Some random data here -->
  </div>
  <div class="col-lg-10 col-md-10 col-sm-10">
<?php
$result=mysqli_query($conn,"SELECT * FROM done where Status='Pending'");
$counter=1;
while ($row=mysqli_fetch_assoc($result)) {
$btime=strtotime($row['Timebooked']);
$ctime=strtotime(date('Y-m-d H:i:s'));
$ctime2=$ctime+10800;
$elapsed=($ctime2-$btime)/60;
$elapsed2=round($elapsed,0);
 $ID=$row['ID'];
if ($elapsed2>90) {
  $diff1=$elapsed2-90;
  $extra=$diff1*40;
  $pay=2500+$extra;
}
else {
  $pay=2500;
}
  echo '<div class="flip-card">
   <div class="flip-card-inner">
     <div class="flip-card-front">
       <hr height="110">
<h3>'.$row['Artist'].'</h3>
  </div>
     <div class="flip-card-back">
       <h4>Booth:</h4>'.$row['Artist'].'
       <h4>Client:</h4>'.$row['Client'].'
       <h4>Start Time:</h4>'.$row['Timebooked'].'
       <h4>Elapsed Time:</h4>'.$elapsed2.' Minutes
       <h4>Total Pay:</h4> Ksh. '.$pay.'.
       <br>

       <form class="form-group" action="transition.php" method="post">
         <input type="number" hidden name="elapsed" value='.$elapsed2.'>
         <input type="text" hidden name="ID" value='.$ID.' >
         <input type="text" hidden name="amount" value='.$pay.' >
         <input type="text" hidden name="complete" value="Complete">
            <a href="transition.php?ID='.$ID.'">
  <input type="submit" name="submit" class="btn btn-lg btn-success"  value="Stop">
            </a>
              </form>
     </div>
   </div>
 </div>';
 }


 $counter++;
?>
</div>
<div class="col-lg-1 col-md-1 col-sm-1">

</div>
</div>
</div>
  </body>
</html>
