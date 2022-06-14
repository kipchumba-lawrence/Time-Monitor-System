<?php
include "databaseconfig.php";
$ID=$_REQUEST['ID'];
$del="DELETE FROM client WHERE ID='$ID'";
mysqli_query($conn,$del);
header("Location:adminpanel.php");
 ?>
