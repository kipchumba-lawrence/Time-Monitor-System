<?php
include "databaseconfig.php";
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
  <meta charset="utf-8">
  <title>Time Monitor System</title>
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="jeav.css">
  <link rel="stylesheet" href="Resources/Bootstrap/css/bootstrap.css">
  <script type="text/javascript" src="Resources/jquery.js"></script>
  <script type="text/javascript" src="Resources/Bootstrap/js/bootstrap.js"></script>
  <link rel="icon" type="image" href="Resources/Images/jeav.ico">
  <body>
    <div class="container-fluid">
      <!-- Start WOWSlider.com BODY section -->
<br>
<img src="beauty.png" alt="" class="img-responsive">
<hr>
<hr>
      <div class="row">
          <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
            <br>
        </div>
          <div class="col-md-8 col-lg-8 col-sm-8 col-xs-10">
            <br>
            <div class="form">
              <div class="panel panel-default">
                <div class="panel-heading panel-heading-custom">
                  <h2>Book Your Session Here</h2>
                </div>
                <div class="panel-body">
                  <form class="form-group" action="" method="post">
                    <label>Name:</label>
                    <br>
                    <input type="text" name="name" value="" class="rounded-input" placeholder="Enter your name." required>
                    <br>
                    <label>Time:</label>
                    <select name="time" class="rounded-input">
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
                    <br>
                    <label>Date:</label>
                    <input type="date" name="date" min="<?php echo date('Y-m-d'); ?>" required class="rounded-input">
                    <label>Phone:</label>
                    <input type="text" maxlength="10" name="phone" placeholder="Enter your phone number starting with 07..." required class="rounded-input">
                    <br>
                    <input type="submit" name="submit" value="Book" class="button-17">
                    <br>
                    <br>
                    <i>Wait for mpesa STK to make booking payment of Ksh. 50.<br>
                    Booking fee is non refundable.</i>
                    </form>
                </div>
              </div>
            </div>
          
          </div>
          <div class="col-lg-2 col-md-2 col-sm-">
                <?php
            if (isset($_POST['submit'])) {
                $amount = '500'; //Amount to transact
$phonenuber = $_POST['phone']; // Phone number paying
$Account_no = 'Jeav'; // Enter account number optional
$url = 'https://tinypesa.com/api/v1/express/initialize';
$data = array(
    'amount' => $amount,
    'msisdn' => $phonenuber,
    'account_no'=>$Account_no
);
$headers = array(
    'Content-Type: application/x-www-form-urlencoded',
    'ApiKey: c2B0fPWXKHS' // Replace with your api key
 );
$info = http_build_query($data);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$resp = curl_exec($curl);
$msg_resp = json_decode($resp);

if($msg_resp ->success == 'true'){
    echo "<div class='alert aert-success'>
WAIT FOR MPESA STK POP UP
      </div>";


              $name=$_POST['name'];
              $phone=$_POST['phone'];
              $time=$_POST['time'];
              $date=$_POST['date'];
              $tstamp=$date;
              $tstamp .=" ";
              $tstamp .=$time;
              $query1="INSERT INTO client(Name,Phone,Timebooked,Datebooked, Timestamp) values('$name','$phone','$time','$date','$tstamp')";
              mysqli_query($conn,$query1);
              $query3=mysqli_query($conn,"SELECT Name from station order by RAND() limit 1");
              while ($row=mysqli_fetch_assoc($query3)) {
              $cname=$row['Name'];
              }
              $query2="INSERT INTO bookings(Client,Phone,Artist,Timebooked)values('$name','$phone','$cname','$tstamp')";
              mysqli_query($conn,$query2);
            }
            else {
                
                echo "Insufficient balance. Please ensure you have ksh.500 in your account before booking.
     
                 Thank you.";
            }}
            
             ?>
          </div>
      </div>
    </div>
  </body>
</html>
