<?php
include "databaseconfig.php";
$ID=$_REQUEST['ID'];
$del="DELETE FROM bookings WHERE BookID='$ID'";
mysqli_query($conn,$del);
header("Location:adminpanel.php");
 ?>
