<?php
include "databaseconfig.php";
$id=$_REQUEST['ID'];
$query="SELECT * FROM bookings WHERE BookID='".$id."'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta charset="utf-8">
<title>Jeav Beauty Palour</title>
<link rel="stylesheet" href="Resources/Bootstrap/css/bootstrap.css">
<script type="text/javascript" src="Resources/jquery.js"></script>
<link rel="stylesheet" href="jeav.css">
<script type="text/javascript" src="Resources/Bootstrap/js/bootstrap.js"></script>
<link rel="icon" type="image" href="Resources/Images/jeav.ico">  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<div class="container-fliud">
<div class="row">
  <div class="col-lg-3 col-md-3 col-sm-3"></div>
  <div class="col-lg-6 col-md-6 col-sm-6">
<div class="panel panel-default">
  <div class="panel-heading">
    <h2>Edit Session</h2>
  </div>
  <div class="panel-body">
    <form class="form-group" action="" method="post">
      <?php
      $status="";
      if (isset($_POST['new'])&& $_POST['new']==1) {
        // $id=$_REQUEST['id'];
        $date=$_POST['date'];
        $time=$_POST['time'];
        $tstamp=$date;
        $tstamp .=" ";
        $tstamp .=$time;
        $artist=$_POST['artist'];
        $update="UPDATE bookings set Timebooked='".$tstamp."',Artist='".$artist."',Status='Pending' WHERE ID='".$id."'";
        mysqli_query($conn,$update);
        // echo $tstamp;
        echo '<div class="alert alert-primary">Record updated succesfully
        <br>
        <a href=adminpanel.php><u>Admin Panel</u></a></div>';
      }
      else{
        ?>
      <input type="hidden" name="new" value="1">
      <label>Client:</label>
      <input type="text" name="name" value="<?php echo $row['Client']; ?>" disabled class="form-control">
      <label>Phone:</label>
      <input type="text" name="phone" value="<?php echo $row['Phone']; ?>" disabled class="form-control">
      <label>Timebooked:</label>
      <input type="Timestamp" name="Timestamp
      " value="<?php echo $row['Timebooked']; ?>" class="form-control" disabled>
        <label>New Date:</label>
        <input type="date" name="date" min="<?php echo date('Y-m-d'); ?>"  class="form-control" required>
        <label>New Time:</label>
        <select name="time" class="form-control">
          <option value="06:00:00">6:00.am</option>
          <option value="07:00:00">7:00.am</option>
          <option value="08:00:00">8:00.am</option>
          <option value="09:00:00">9.00.am</option>
          <option value="10:00:00">10.00.am</option>
          <option value="11:00:00">11.00.am</option>
          <option value="12:00:00">12.00.pm</option>
          <option value="13:00:00">1.00.pm</option>
          <option value="14:00:00">2.00.pm</option>
          <option value="15:00:00">3.00.pm</option>
          <option value="16:00:00">4.00.pm</option>
          <option value="17:00:00">5.00.pm</option>
          <option value="18:00:00">6.00.pm</option>
          <option value="19:00:00">7.00.pm</option>
          <option value="20:00:00">8.00.pm</option>
          <option value="21:00:00">9.00.pm</option>
        </select>
        <label>Artist:</label>
        <select class="form-control" name="artist" required>
        <?php
        $sel_query="SELECT * FROM station";
        $result=mysqli_query($conn,$sel_query);
        while($row2=mysqli_fetch_assoc($result))
        {
          $name=$row2['Name'];
          $specialty=$row2['Specialty'];
          echo "<option value='".$name."'>".$name."  |  ".$specialty."</option>";
        }
         ?>
        </select>
        <br>
      <input type="submit" class="btn btn-success btn-md" name="Edit" value="Submit">
              <?php
            }
            ?>

    </form>
  </div>
</div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-3">
    <?php

     ?>
  </div>
</div>
</div>
  </body>
</html>
