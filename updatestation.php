<?php
// $conn' = mysqli_connect("localhost","jeavxyz_jeav","Jeav2021!","jeavxyz_jeav");
include "databaseconfig.php";
$id=$_REQUEST['id'];
$query="SELECT * FROM station WHERE id='".$id."'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
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
  </head>
  <body>
    <div class="container-fluid">
      <nav class="navbar navbar-default">
    <div class="container-fluid">
     <div class="navbar-header">
       <a class="navbar-brand" href="#">
         <!-- <img src="Resources/Images/jeav.png" alt="" height="35" width="35"> -->
       </a>
     </div>
     <ul class="nav navbar-nav">
       <li><a href="active.php">Activity</a></li>
       <li class="active"><a href="station.php">Stations</a></li>
       <li><a href="#">Admin Panel</a></li>
     </ul>
     <ul class="nav navbar-nav navbar-right">
       <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
       <li><a href="#"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
     </ul>
    </div>
    </nav>
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3"></div>
        <div class="col-lg-6 col-md-6 col-sm-6">
<div class="panel panel-success panel-lg">
  <div class="panel-heading">
    <h2>Station Update</h2>
  </div>
  <div class="panel-body">
    <form class="" action="" method="post">
      <?php
      $status="";
      if (isset($_POST['new'])&& $_POST['new']==1) {
        $id=$_REQUEST['id'];
        $name=$_REQUEST['Name'];
        // $phone=$_REQUEST['Phone'];
        $specialty=$_REQUEST['Console'];
        $update="UPDATE station set Name='".$name."',Console='".$specialty."' WHERE id='".$id."'";
        mysqli_query($conn,$update);
        $status="Record Updated succesfully.<br><a href='station.php>View Stations</a>'";
        echo $status;
      }else {
         ?>
         <input type="hidden" name="new" value="1">
         <label>Number :</label>
         <input type="text" name="Name" class="form-control" value="<?php echo $row['Name']; ?>">
         <!-- <label>Phone:</label> -->
         <!-- <input type="number" name="Phone" class="form-control" value="<?php echo $row['Phone']; ?>"> -->
         <label>Console:</label>
         <input type="text" class="form-control" name="Console" value="<?php echo $row['Console']; ?>">
         <br>
         <input type="submit" name="update" value="Update" class="btn btn-lg btn-primary">
         <!-- <a href="delete.php?id=<?php $id ?>"><button type="button" name="delete" class="btn btn-danger btn-lg">Delete</button></a> -->
    </form>
  <?php } ?>
  </div>
</div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
          <!--  -->
        </div>
      </div>
    </div>
  </body>
</html>
