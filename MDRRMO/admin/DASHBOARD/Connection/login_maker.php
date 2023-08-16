<?php
$conn=mysqli_connect("localhost","root","");
mysqli_select_db($conn,"mdrrmodb");

$uname=$_GET['t1'];
$pwd=$_GET['t2'];

$qry="SELECT * from user_tbl where user_username='$uname' and user_password='$pwd' AND user_verification = 'VERIFIED' ";
$qry1="SELECT * from user_tbl where user_username='$uname' and user_password='$pwd' AND user_verification = 'Non-Verified'";
$raw=mysqli_query($conn,$qry);
$raw1=mysqli_query($conn,$qry1);
$count=mysqli_num_rows($raw);
$count1=mysqli_num_rows($raw1);



if($count1>0)
 echo "Please Verify";

else if($count>0)
 echo "FOUND";

else
 echo "Account Not Found ";
?>