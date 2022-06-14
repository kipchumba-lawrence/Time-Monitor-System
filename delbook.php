<?php
include "databaseconfig.php";
$ID=$_REQUEST['ID'];
$del="Delete FROM bookings WHERE BookID='$ID'";
mysqli_query($conn,$del);
header("Location:adminpanel.php");
 ?>
