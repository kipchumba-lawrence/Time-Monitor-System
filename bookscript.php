<?php
$conn = mysqli_connect("localhost","jeavxyz_jeav","Jeav2021!","jeavxyz_jeav");
$getter=mysqli_query($conn,"SELECT * FROM bookings");
$now=date('Y-m-d H:i:s');
echo $now;
$unix=strtotime($now);
echo "</br>";
echo $unix;
$unixnew=$unix+10800;
echo "<br>";
echo $unixnew;
while ($row=mysqli_fetch_assoc($getter)) {
  $newts=strtotime($row['Timebooked']);
  echo "<br>";
  echo $newts;
  $diff=$newts-$unixnew;
  if ($diff<1200 && $diff>-100) {
     $client=$row['Client'];
    $artist=$row['Artist'];
    $Phone=$row['Phone'];
    $time=$row["Timebooked"];
    $ins="INSERT INTO done(Client,Phone,Artist,Timebooked) values('$client','$Phone','$artist','$time')";
    mysqli_query($conn,$ins);
  }
}
// while ($row=mysqli_fetch_assoc($getter)){
//   $unixts=strtotime($row['Timebooked']);
//   if ($unixts==$unixnew) {
    // $client=$row['Client'];
    // $artist=$row['Artist'];
    // $time=$row["Timebooked"];
    // $ins="INSERT INTO done(Client,Artist,Timebooked) values('$client','$artist','time')";
    // mysqli_query($conn,$ins);
//   }
// }
 ?>
