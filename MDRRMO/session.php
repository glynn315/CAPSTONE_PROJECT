<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   $ses_sql = mysqli_query($db,"SELECT * from emp_tbl where emp_username = '$user_check'");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['emp_id'];
   $name = $row['emp_fname'] ." " . $row['emp_lname'] ;
   $address = $row['emp_address'];
   $gender = $row['emp_gender'];
   $contact = $row['emp_contact'];
   $bday = $row['emp_bday'];
   $image = $row['image'];
   if(!isset($_SESSION['login_user'])){
      header("location:../../login.php");
      die();
   }
?>