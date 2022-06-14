<?php
include "databaseconfig.php";
$ID=$_REQUEST['ID'];
$del="DELETE FROM station WHERE id='$ID'";
mysqli_query($conn,$del);
header("Location:adminpanel.php");
 ?>
