<?php
include "databaseconfig.php";
if (isset($_POST['submit'])) {
  $ID=$_POST['ID'];
  $ELAP=$_POST['elapsed'];
  $amt=$_POST['amount'];
  $updater="UPDATE done set Status='Complete',Timespent='".$ELAP."',Amount='".$amt."' WHERE ID='".$ID."'";
  // $inserter="INSERT INTO done(Timespent,Amount) values('$elapsed2','$pay')";
  mysqli_query($conn,$updater);
  // mysqli_query($conn,$inserter);
header("Location:print.php?ID=$ID");
} ?>
