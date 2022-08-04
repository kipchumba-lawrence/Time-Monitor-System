<?php
$id = $_REQUEST['ID'];
include "databaseconfig.php";
$selector = "SELECT * FROM done WHERE ID='" . $id . "'";
$result = mysqli_query($conn, $selector);
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["username"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
while ($row = mysqli_fetch_assoc($result)) {
?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Time Monitor System</title>
    <link rel="stylesheet" href="Resources/Bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="Resources/jquery.js"></script>
    <link rel="stylesheet" href="jeav.css">
  </head>

  <body>
    <div class="ticket">
      <img src="Resources/Images/jeav.png" height="35" width="35" alt="Logo">
      <p class="centered"><strong>TIME MONITOR SYSTEM</strong>
      </p> _______________________
      <br>
      <strong>Name: </strong><?php echo $row['Client']; ?>
      <br>
      <strong>Artist: </strong><?php echo $row['Artist']; ?>
      <br>
      <strong>Total Time:</strong><?php echo $row['Timespent']; ?>.
      <br>
      <strong>Reserved Time:</strong>90 Minutes.
      <br>
      <strong>Base Charge:</strong>2,000
      <br>
      <strong>Extra Time:</strong><?php
                                  $timespent = $row['Timespent'];
                                  $extratime = $timespent - 90;
                                  if ($extratime > 1) {
                                    echo $extratime;
                                  } else {
                                    echo "0";
                                  }
                                  ?>
      <br>
      <strong>Extra Charge:</strong>
      <?php
      if ($extratime > 1) {
        $extrapay = $extratime * 40;
        echo $extrapay;
      } else {
        $extrapay = 0;
        echo $extrapay;
      }
      ?>
      <br>
      <strong>Booking Fee:</strong> 500.
      <br>
      <strong>Total Charge:</strong>
      <?php
      $total = $extrapay + 2000;
      echo $total;
      ?>
      <br>
      _______________________
      <br>
      Paybill Number: 3013035
      <br>
      Account No.: TIME MONITOR
      <br>
      _______________________
      <p class="centered">Thanks for your purchase!
    </div>
    <button id="btnPrint" class="hidden-print btn btn-md btn-success">Print <span class="glyphicon glyphicon-print"></span> </button>
    <a href="active.php">
      <button type="button" name="button" class="btn-primary btn btn-md hidden-print">Activities <span class="glyphicon glyphicon-time"></span> </button>
    </a>
    <script src="script.js"></script>
  </body>

  </html>
<?php
}
?>