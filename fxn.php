<?php
include 'active.php';
$conn = mysqli_connect("localhost","root","","jeav");
if (isset($_POST['submit'])) {
  // $elap=$_POST['elasped'];
  // $ID=$row['ID'];
$amount=$_POST['amount'];
$compl=$_POST['complete'];
$update="UPDATE done set Timespent='".$elapsed2."',Amount='".$pay."',Status='".$compl."' where ID='".$ID."'";
  mysqli_query($conn,$update);
  header("location:print.php?ID=$ID");
}

 ?>
