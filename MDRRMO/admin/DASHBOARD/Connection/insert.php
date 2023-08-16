<?php
require "connect.php";

$Fname = isset($_POST["fname"]) ? $_POST["fname"] : '';;
$Lname = isset($_POST["lname"]) ? $_POST["lname"] : '';;
$Contact = isset($_POST["contact"]) ? $_POST["contact"] : '';;
$Register = isset($_POST["reg"]) ? $_POST["reg"] : '';;
$Gender = isset($_POST["gen"]) ? $_POST["gen"] : '';;
$Username = isset($_POST["username"]) ? $_POST["username"] : '';;
$Password = isset($_POST["password"]) ? $_POST["password"] : '';;
$date = date('Y-m-d');
$img=$_POST['upload'];

$filename="IMG".rand().".jpg";
file_put_contents("../uploads/".$filename,base64_decode($img));
$sql = "INSERT INTO user_tbl(user_fname,user_lname,address_id,user_contact,user_bday,date_registered,user_gender,user_username,user_password,user_image,user_status,user_verification) VALUES('$Fname','$Lname','1','$Contact','$Register','$date','$Gender','$Username','$Password','$filename','ACTIVE','Non-Verified');";

if(mysqli_query($con,$sql))
{

echo "Succesfully saved";

}
else
{
echo "Error in insertion ..." .mysqli_error($con) ;

}
?>