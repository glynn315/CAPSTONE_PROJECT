<?php
require "connect.php";

$First = $_POST["samp"];
$Long = $_POST["longs"];
$Lat = $_POST["lats"];
$date = date('Y-m-d');
$img=$_POST['upload'];

$filename="IMG".rand().".jpg";
file_put_contents("../uploads/".$filename,base64_decode($img));
$sql = "INSERT INTO request_tbl(user_id,longitude,latitude,req_status,request_date,image) VALUES('$First','$Long','$Lat','PENDING','$date','$filename');";

if(mysqli_query($con,$sql))
{

echo "Succesfully saved";

}
else
{
echo "Error in insertion ..." .mysqli_error($con) ;

}
?>
