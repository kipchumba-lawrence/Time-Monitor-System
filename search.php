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
 <meta charset="utf-8">
 <title>Jeav Beauty Palour</title>

 <link rel="stylesheet" href="Resources/Bootstrap/css/bootstrap.css">
 <script type="text/javascript" src="Resources/jquery.js"></script>
 <link rel="stylesheet" href="jeav.css">
 <script type="text/javascript" src="Resources/Bootstrap/js/bootstrap.js"></script>
 <link rel="icon" type="image" href="Resources/Images/jeav.ico">
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
   <li><a href="active.php"><span class="glyphicon glyphicon-time"></span> Activity</a></li>
   <li><a href="station.php"> <span class="glyphicon glyphicon-edit"></span> Stations</a></li>
   <li><a href="adminpanel.php"> <span class="glyphicon glyphicon-list"></span> Admin Panel</a></li>
   <li class="active"><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
  </ul>
  <ul class="nav navbar-nav navbar-right">
    <li>Welcome:<strong> <?php echo $_SESSION['username']; ?></strong> <span class="glyphicon glyphicon-user"></span></li>
    <li> <a href="logout.php">
            Logout <span class="glyphicon glyphicon-log-out"></span></a> </li> </ul>
  </div>
  </nav>
  <br>
  <div class="row">
    <div class="col-md-1 col-lg-1">
<!-- No data to be input here yet -->
    </div>
    <div class="col-lg-8 col-md-8">
        <form class="form-inline" action="search.php" method="post">
          <input type="text" maxlength="10" name="number" required placeholder="Enter Phone number to search" class="form-control">
          <select class="form-control" name="table">
            <option value="Clients">Clients</option>
            <option value="Linked Bookings">Linked Bookings</option>
            <option value="Processed Booking">Processed Bookings</option>
          </select>
        <button type="submit" name="button" class="btn btn-md btn-success"> <span class="glyphicon glyphicon-search"></span> Search </button>
        </form>
        <hr>
        <?php
        if (isset($_POST['button'])) {
          $choice=$_POST['table'];
          if ($choice=='Clients') {
            $table="client";
              ?>
              <table class="table-striped table">
                <thead>
                  <tr>
                    <th><center>S.No</center></th>
                    <th><center>Client</center></th>
                    <th><center>Phone</center></th>
                    <th><center>Timebooked</center></th>
                    <!-- <th><center>Update</center></th> -->
                    <th><center>Delete</center></th>
                  </tr>
                </thead>
              <tbody>
              <?php
              $number=$_POST['number'];
              $query="SELECT * FROM  client WHERE Phone=$number";
              $count2=1;
              $selector=mysqli_query($conn,$query);
              while ($row=mysqli_fetch_assoc($selector)) {
               ?>
               <tr>
                 <td align="center"><?php echo $count2; ?></td>
                 <td align="center"><?php echo $row['Name']; ?></td>
                 <td align="center"><?php echo $row['Phone']; ?></td>
                 <td align="center"><?php echo $row['Timebooked']; ?></td>
                 <!-- <td align="center"> <a href="update4.php?ID=<?php echo $row['ID']; ?>"> <button type="button" name="button" class="btn btn-primary btn-md">Update</button> </a> </td> -->
                  <td align="center"> <a href="delclient.php?ID=<?php echo $row['ID']; ?>"> <button type="button" name="button" class="btn btn-danger btn-md">Delete</button> </a> </td>

               </tr>
             <?php
             $count2++;
            } ?>
              </tbody>
            </table>
<?php
          }

          elseif ($choice=="Linked Bookings") {
            ?>
            <table class="table-striped table">
              <thead>
                <tr>
                  <th><center>S.No</center></th>
                  <th><center>Client</center></th>
                  <th><center>Phone</center></th>
                  <th><center>Artist</center></th>
                  <th><center>Timebooked</center></th>
                  <th><center>Update</center></th>
                  <th><center>Delete</center></th>
                </tr>
              </thead>
            <tbody>
            <?php
            // $table="bookings";
              $number=$_POST['number'];
              $selector2="SELECT * FROM bookings WHERE Phone=$number";
              $count2=1;
              $result2=mysqli_query($conn,$selector2);
              while ($row=mysqli_fetch_assoc($result2)) {
               ?>
               <tr>
                 <td align="center"><?php echo $count2; ?></td>
                 <td align="center"><?php echo $row['Client']; ?></td>
                 <td align="center"><?php echo $row['Phone']; ?></td>
                 <td align="center"><?php echo $row['Artist']; ?></td>
                 <td align="center"><?php echo $row['Timebooked']; ?></td>
                 <td align="center"> <a href="update3.php?ID=<?php echo $row['BookID']; ?>"> <button type="button" name="button" class="btn btn-primary">Update</button> </a> </td>
                  <td align="center"> <a href="delete.php?ID=<?php echo $row['BookID']; ?>"> <button type="button" name="button" class="btn btn-danger">Delete</button> </a> </td>
               </tr>
              <?php
              $count2++;
              }


          }

          elseif ($choice=="Processed Booking") {
?>
<table class="table-striped table">
  <thead>
    <tr>
      <th><center>S.No</center></th>
      <th><center>Client</center></th>
      <th><center>Artist</center></th>
      <th><center>Timebooked</center></th>
      <th><center>Timespent</center></th>
      <th><center>Amount</center></th>
      <th><center>Status</center></th>
      <th><center>Print</center></th>
      <th><center>Edit</center></th>
    </tr>
  </thead>
<tbody>
<?php
$number=$_POST['number'];
$selector3="SELECT * FROM done WHERE Phone=$number";
$count3=1;
$result3=mysqli_query($conn,$selector3);
while ($row=mysqli_fetch_assoc($result3)) {
 ?>
 <tr>
   <td align="center"><?php echo $count3; ?></td>
   <td align="center"><?php echo $row['Client']; ?></td>
   <td align="center"><?php echo $row['Artist']; ?></td>
   <td align="center"><?php echo $row['Timebooked']; ?></td>
   <td align="center"><?php echo $row['Timespent']; ?></td>
   <td align="center"><?php echo $row['Amount']; ?></td>
   <td align="center"><?php echo $row['Status']; ?></td>
   <td align="center"> <a href="print.php?ID=<?php echo $row['ID']; ?>"> <button type="button" name="button" class="btn btn-primary">Update</button> </a> </td>
    <td align="center"> <a href="delete2.php?ID=<?php echo $row['ID']; ?>"> <button type="button" name="button" class="btn btn-danger">Delete</button> </a> </td>
 </tr>
<?php
$count3++;
}}} ?>

</div>
    <div class="col-lg-3 col-md-3"></div>
  </div>
</div>
   </body>
 </html>
