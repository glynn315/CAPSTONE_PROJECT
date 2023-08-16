<?php
	include('../../session.php');
	$link=mysqli_connect("localhost" , "root" , "");
	mysqli_select_db($link,"mdrrmodb");
	if (isset($_POST["view"])) {
		header("Location:user_view.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
	<link rel="stylesheet" href="../CSS/nav.css">
	<link rel="stylesheet" href="../CSS/style.css">
	<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
	<title>MDRRMO</title>
</head>
<body>
	<div class="wrapper">
 		<nav id="sidebar">
 	 	<ul class="list-unstyled components">
 	 		<p>MDRRMO Staff Info</p>
 	 		<li >
	 	 		<a href="../index.php">Dashboard</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="users.php">Users List</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="#">Verification Request</a>
	 	 	</li>
	 	</ul>
	 	</nav>
		<div id="content">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  		<div class="container-fluid">
		  			<button type="button" id="sidebarCollapse" class="btn  btn-info">
		  				<i class="fas fa-align-left"></i>	
		  			</button>
		  		</div>
		  	</nav>
		    <div class=".container-fluid cc">
		    	<div class="table-responsive">
					<form method="POST">
						<table id="employee_data" class="table table-fluid">
							<thead>
								<tr>
									<td>#</td>
									<td>User Name</td>
									<td>Contact #</td>
									<td>Date Register</td>
									<td>User Status</td>
									<td>User Verification</td>
									<td></td>
								</tr>
							</thead>
							<?php
								$res = mysqli_query($link, "SELECT * from user_tbl");
								while($row=mysqli_fetch_array($res))
								{
									echo "<tr>";
									echo "<td>"; echo $row["user_id"]; echo "</td>";
									echo "<td>"; echo $row["user_fname"]." " . $row["user_lname"]; echo "</td>";
									echo "<td>"; echo $row["user_contact"]; echo "</td>";
									echo "<td>"; echo $row["date_registered"]; echo "</td>";
									echo "<td>"; echo $row["user_status"]; echo "</td>";
									echo "<td>"; echo $row["user_verification"]; echo "</td>";
									echo "<td><button type='submit' name='view'>VIEW</button>";"</td>";
									echo "</tr>";
								}
							?>
						</table>
					</form>
				</div>
			</div>
		    
		</div>
	</div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>  
	$(document).ready(function(){  
    $('#employee_data').DataTable();  
 	});  
</script> 
<script> 
$(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

</script>

</body>
</html>