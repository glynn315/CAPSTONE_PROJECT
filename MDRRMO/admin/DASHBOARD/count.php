<?php
$link=mysqli_connect("localhost" , "root" , "");
mysqli_select_db($link,"mdrrmodb");

$com ="SELECT * FROM request_tbl WHERE req_status = 'PENDING'";
$user = mysqli_query($link , $com);
$count = mysqli_num_rows($user);

$com1 ="SELECT * FROM emp_tbl WHERE emp_status = 'ACCESSIBLE' AND role_id = '2'";
$user1 = mysqli_query($link , $com1);
$count1 = mysqli_num_rows($user1);

$com2 ="SELECT * FROM user_tbl WHERE user_status = 'ACTIVE'";
$user2 = mysqli_query($link , $com2);
$count2 = mysqli_num_rows($user2);

$com3 ="SELECT * FROM announcement_tbl WHERE announcement_status = 'ACTIVE'";
$user3 = mysqli_query($link , $com3);
$count3 = mysqli_num_rows($user3);
?>