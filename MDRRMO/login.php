<?php
include("config.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myusername = mysqli_real_escape_string($db,$_POST['txtuser']);
      $mypassword = mysqli_real_escape_string($db,$_POST['txtpass']); 
      $sql = "SELECT * FROM emp_tbl WHERE emp_username = '$myusername' and emp_password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $role = $row["role_id"];
      $act = $row["emp_status"];
      $count = mysqli_num_rows($result);
      if($count == 1) 
      {
      	if ($role == "2") 
      	{
      		if ($act == "INACCESSIBLE") 
      		{
      			$error = "System is Under Maintenance";
      		}
      		else
      		{
      			$_SESSION['login_user'] = $myusername;
         		header("location: staff/DASHBOARD/index.php"); 
      		}
      	}
      	if ($role == "1") {
      		if ($act == "INACCESSIBLE") 
      		{
      			$error = "System is Under Maintenance";
      		}
      		else
      		{
      			$_SESSION['login_user'] = $myusername;
         		header("location: admin/DASHBOARD/index.php"); 
      		}
      	}

      }
      else 
      {
         $error = "Your Login Name or Password is invalid";
      }
     
   }
   else
      	{
      		$error = "";
      	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="login.css">
	<title>LOGIN</title>
</head>
<body>
	<img src="logo.png">
	<div class="center">
		<h1>LOGIN</h1>
		<form method="post">
			<div class="txt_field">
				<input type="text" name="txtuser" required>
				<span></span>
				<label>Username</label>
			</div>
			<div class="txt_field">
				<input type="password" name="txtpass" required>
				<span></span>
				<label>Password</label>
			</div>		
			<input type="submit" value="Login" name="subLog">			
		</form>
		</div>
	

</body>
</html>	