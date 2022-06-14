<?php
$conn = mysqli_connect("localhost","jeavxyz_jeav","Jeav2021!","jeavxyz_jeav");
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
  <title>Jeav Beauty Palour</title>
  <link rel="stylesheet" href="jeav.css">
  <link rel="stylesheet" href="Resources/Bootstrap/css/bootstrap.css">
  <script type="text/javascript" src="Resources/jquery.js"></script>
  <script type="text/javascript" src="Resources/Bootstrap/js/bootstrap.js"></script>
  <link rel="icon" type="image" href="Resources/Images/jeav.ico">
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
       <li><a href="active.php">Home</a></li>
       <li class="active"><a href="station.php">Stations</a></li>
       <li><a href="adminpanel.php">Admin Panel</a></li>
     </ul>
  </ul>
  <ul class="nav navbar-nav navbar-right">
    <li>Welcome:<strong> <?php echo $_SESSION['username']; ?></strong> <span class="glyphicon glyphicon-user"></span></li>
    <li> <a href="logout.php">
            Logout <span class="glyphicon glyphicon-log-out"></span></a> </li> </ul>
   </div>
 </nav>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-4">
        <h2>
        Registered Stations</h2>
      <table class="table-striped table">
        <thead>
          <tr>
            <th><center>S.No</center></th>
            <th><center>Name</center></th>
            <th><center>Phone</center></th>
            <th><center>Specialty</center></th>
            <th><center>Update</center></th>
          </tr>
        </thead>
      <tbody>
      <?php
      $selector1="SELECT * FROM station";
      $count1=1;
      $result1=mysqli_query($conn,$selector1);
      while ($row=mysqli_fetch_assoc($result1)) {
       ?>
       <tr>
         <td align="center"><?php echo $count1; ?></td>
         <td align="center"><?php echo $row['Name']; ?></td>
         <td align="center"><?php echo $row['Phone']; ?></td>
         <td align="center"><?php echo $row['Specialty']; ?></td>
         <td align="center"><a href="updatestation.php?id=<?php echo $row['id']?>">
             <button type="button" class="btn btn-lg btn-primary" name="button">Update</button> </a></td>
       </tr>
     <?php
     $count1++;
    } ?>
      </tbody>
    </table>
    </div>
      <div class="col-lg-6 col-md-6">
<div class="panel panel-success panel-lg">
  <div class="panel-heading">
    <center>
      <h2>Register Stations</h2>
    </center>
  </div>
  <div class="panel-body">
      <form class="form-group" action="" method="post">
        <label>Artist Name:</label>
        <input type="text" name="name" required value="" placeholder="Input artist's name here." class="form-control">
        <label>Phone Number:</label>
        <input type="text" name="phone" value="" maxlength="10" placeholder="Input artist's phone number." required title="phone" class="form-control">
        <label>Specialty:</label>
        <select class="form-control" name="spec">
          <option value="Makeup">Makeup</option>
          <option value="Nails">Nails</option>
          <option value="Hair">Hair</option>
        </select>
        <br>
<center>
  <input type="submit" name="submit" value="Register" class="btn btn-lg btn-success">

</center>
      </form>
  </div>
</div>      </div>
      <div class="col-lg-2 col-md-2">
      <?php
if (isset($_POST['submit'])) {
  $name=$_POST['name'];
  $phone=$_POST['phone'];
  $spec=$_POST['spec'];
  $query="INSERT INTO station(Name,Phone,Specialty) values('$name','$phone','$spec')";
  mysqli_query($conn,$query);
  echo "Record inserted succesfully.";
}
       ?>
     </div>
    </div>
  </body>
</html>
