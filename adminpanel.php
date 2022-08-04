<?php
include 'databaseconfig.php';
// include 'script.php';
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["username"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Time Monitor System</title>
  <link rel="stylesheet" href="Resources/Bootstrap/css/bootstrap.css">
  <script type="text/javascript" src="Resources/jquery.js"></script>
  <link rel="stylesheet" href="jeav.css">
  <script type="text/javascript" src="Resources/Bootstrap/js/bootstrap.js"></script>
</head>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">
            <!-- <img src="Resources/Images/jeav.png" alt="" height="35" width="35"> -->
          </a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="active.php"><span class="glyphicon glyphicon-time"></span> Activity</a></li>
          <li><a href="station.php"> <span class="glyphicon glyphicon-edit"></span> Stations</a></li>
          <li class="active"><a href="adminpanel.php"> <span class="glyphicon glyphicon-list"></span> Admin Panel</a></li>
          <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>Welcome:<strong> <?php echo $_SESSION['username']; ?></strong> <span class="glyphicon glyphicon-user"></span></li>
          <li> <a href="logout.php">
              Logout <span class="glyphicon glyphicon-log-out"></span></a> </li>
        </ul>
      </div>
    </nav>
    <div class="row">
      <div class="col-lg-2 cok-sm-2 col-md-2">
        <!-- Some random data here -->
        <div class="alert alert-success">
          <a href="registerstation.php" class="alert-link"> <strong>Register Station</strong></a>.
        </div>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-10">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home">Stations</a></li>
          <li><a data-toggle="tab" href="#menu1">Bookings</a></li>
          <li><a data-toggle="tab" href="#menu2">Processed Bookings</a></li>
          <li><a data-toggle="tab" href="#menu3">Clients</a></li>
          <!-- <li><a data-toggle="tab" href="#menu4">Statistics</a></li> -->
        </ul>

        <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
            <h3>Stations</h3>
            <p>
            <table class="table-striped table">
              <thead>
                <tr>
                  <th>
                    <center>S.No</center>
                  </th>
                  <th>
                    <center>Name</center>
                  </th>

                  <th>
                    <center>Console</center>
                  </th>
                  <th>
                    <center>Update</center>
                  </th>
                  <th>
                    <center>Delete</center>
                  </th>

                </tr>
              </thead>
              <tbody>
                <?php
                $selector1 = "SELECT * FROM station";
                $count1 = 1;
                $result1 = mysqli_query($conn, $selector1);
                while ($row = mysqli_fetch_assoc($result1)) {
                ?>
                  <tr>
                    <td align="center"><?php echo $count1; ?></td>
                    <td align="center"><?php echo $row['Name']; ?></td>
                    <td align="center"><?php echo $row['Console']; ?></td>

                    <td align="center"><a href="updatestation.php?id=<?php echo $row['id'] ?>">
                        <button type="button" class="btn btn-md btn-primary" name="button">Update</button> </td>
                    <td align="center"> <a href="delete1.php?ID=<?php echo $row['id']; ?>"> <button type="button" name="button" class="btn btn-md btn-danger">Delete</button> </a> </td>
                  </tr>
                <?php
                  $count1++;
                } ?>
              </tbody>
            </table>
            </p>
          </div>

          <div id="menu1" class="tab-pane fade">
            <h3>Bookings</h3>
            <p>
            <table class="table-striped table">
              <thead>
                <tr>
                  <th>
                    <center>S.No</center>
                  </th>
                  <th>
                    <center>Client</center>
                  </th>
                  <th>
                    <center>Phone</center>
                  </th>

                  <th>
                    <center>Timebooked</center>
                  </th>
                  <!-- <th><center>Update</center></th>
                  <th><center>Delete</center></th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $selector2 = "SELECT * FROM bookings ORDER BY Timebooked DESC";
                $count2 = 1;
                $result2 = mysqli_query($conn, $selector2);
                while ($row = mysqli_fetch_assoc($result2)) {
                ?>
                  <tr>
                    <td align="center"><?php echo $count2; ?></td>
                    <td align="center"><?php echo $row['Client']; ?></td>
                    <td align="center"><?php echo $row['Phone']; ?></td>

                    <td align="center"><?php echo $row['Timebooked']; ?></td>
                    <td align="center"> <a href="update3.php?ID=<?php echo $row['BookID']; ?>"> <button type="button" name="button" class="btn btn-primary">Update</button> </a> </td>
                    <td align="center"> <a href="delete.php?ID=<?php echo $row['BookID']; ?>"> <button type="button" name="button" class="btn btn-danger">Unbook</button> </a> </td>
                  </tr>
                <?php
                  $count2++;
                } ?>
              </tbody>
            </table>
            </p>
          </div>
          <!-- </div> -->
          <div id="menu2" class="tab-pane fade">
            <!-- <div id="menu1" class="tab-pane fade"> -->
            <h3>Processed Bookings</h3>
            <p>
            <table class="table-striped table">
              <thead>
                <tr>
                  <th>
                    <center>S.No</center>
                  </th>
                  <th>
                    <center>Client</center>
                  </th>

                  <th>
                    <center>Timebooked</center>
                  </th>
                  <th>
                    <center>Timespent</center>
                  </th>
                  <th>
                    <center>Amount</center>
                  </th>
                  <th>
                    <center>Status</center>
                  </th>
                  <!-- <th><center>Print</center></th>
                    <th><center>Edit</center></th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $selector3 = "SELECT * FROM done ORDER BY Timebooked DESC";
                $count3 = 1;
                $result3 = mysqli_query($conn, $selector3);
                while ($row = mysqli_fetch_assoc($result3)) {
                ?>
                  <tr>
                    <td align="center"><?php echo $count3; ?></td>
                    <td align="center"><?php echo $row['Client']; ?></td>

                    <td align="center"><?php echo $row['Timebooked']; ?></td>
                    <td align="center"><?php echo $row['Timespent']; ?></td>
                    <td align="center"><?php echo $row['Amount']; ?></td>
                    <td align="center"><?php echo $row['Status']; ?></td>
                    <td align="center"> <a href="print.php?ID=<?php echo $row['ID']; ?>"> <button type="button" name="button" class="btn btn-primary">Print</button> </a> </td>

                    <td align="center">
                      <a href="update2.php?ID=<?php echo $row['ID']; ?>">
                        <button type="button" name="button" class="btn btn-danger">Edit</button>
                      </a>
                    </td>
                  </tr>
                <?php
                  $count3++;
                } ?>
              </tbody>
            </table>
            </p>
          </div>

          <div id="menu3" class="tab-pane fade">
            <h3>Bookings</h3>
            <p>
            <table class="table-striped table">
              <thead>
                <tr>
                  <th>
                    <center>S.No</center>
                  </th>
                  <th>
                    <center>Name</center>
                  </th>
                  <th>
                    <center>Phone</center>
                  </th>
                  <th>
                    <center>Timebooked</center>
                  </th>
      
                </tr>
              </thead>
              <tbody>
                <?php
                $selector4 = "SELECT * FROM client ORDER BY Timestamp DESC";
                $count4 = 1;
                $result4 = mysqli_query($conn, $selector4);
                while ($row = mysqli_fetch_assoc($result4)) {
                ?>
                  <tr>
                    <td align="center"><?php echo $count4; ?></td>
                    <td align="center"><?php echo $row['Name']; ?></td>
                    <td align="center"><?php echo $row['Phone']; ?></td>
                    <td align="center"><?php echo $row['Timestamp']; ?></td>
                
                    <td align="center"> <a href="delclient.php?ID=<?php echo $row['ID']; ?>"> <button type="button" name="button" class="btn btn-danger">Remove</button> </a> </td>
                  </tr>
                <?php
                  $count4++;
                } ?>
              </tbody>
            </table>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>