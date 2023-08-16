<?php
	include('../../session.php');
	include('count.php');
	$link=mysqli_connect("localhost" , "root" , "");
	mysqli_select_db($link,"mdrrmodb");
	$query ="SELECT request_tbl.emer_type,user_tbl.user_fname,user_tbl.user_lname,request_tbl.request_date,emp_tbl.emp_fname,emp_tbl.emp_lname,emp_tbl.emp_id FROM request_tbl INNER JOIN user_tbl ON request_tbl.user_id = user_tbl.user_id INNER JOIN emp_tbl ON request_tbl.emp_id = emp_tbl.emp_id WHERE emp_tbl.emp_id = $login_session;";  
 	$result = mysqli_query($link, $query); 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
	<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>

  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  	
  	<link rel="stylesheet" href="../CSS/nav.css">
	<link rel="stylesheet" href="../CSS/style.css">

	<title>MDRRMO</title>
</head>
<body>
	<div class="wrapper">
 		<nav id="sidebar">
 	 	<ul class="list-unstyled components">
 	 		<img src="../../logo/logo.png" class="header">
 	 		<p><?php echo $name ?><br></p>
 	 		<li style="margin-top:-9%;" class="active">
	 	 		<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><img src="../../logo/a.png" style="width:10px;"> ACTIVE</a>
	 	 		<ul class="collapse list-unstyled" id="pageSubmenu">
	 	 			<li>
	 	 				<a href="info.php">Account Settings</a>
	 	 			</li>
	 	 			<li>
	 	 				<a href="../DASHBOARD/logout.php">Logout</a>
	 	 			</li>
	 	 		</ul>
	 	 	</li>
 	 		
 	 		<hr>
 	 		<li>
	 	 		<a href="index.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="../staff_module/staff.php"><i class="bi bi-people"></i> Staff</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="../users_module/users.php"><i class="bi bi-person-lines-fill"></i> Users List</a>
	 	 	</li>
 	 	 	<li>
 	 			<a href="../maintenance_module/maintenance.php"><i class="bi bi-gear-wide-connected"></i> Maintenance</a>
 	 		</li>
 	 		<li>
 	 			<a href="../emergency_module/emergency.php"><i class="bi bi-hospital"></i> Emergency Occurance</a>
 	 		</li>
	 	 	<li>
 	 			<a href="../other_module/other.php"><i class="bi bi-motherboard"></i> Others</a>
 	 		</li>
 	 		<li>
	 	 		<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-file-text"></i> Reports</a>
	 	 		<ul class="collapse list-unstyled" id="homeSubmenu">
		 	 	  	<li>
		 	 	  		<a href="../reports_module/vehicular.php">Vehicular Accidents Report</a>
		 	 	  	</li>
		 	 	  	<li>
		 	 	  		<a href="../reports_module/calamity.php">Natural Calamity Incidents Report</a>
		 	 	  	</li>
		 	 	  	<li>
		 	 	  		<a href="../reports_module/emegency.php">Emergency Accidents Report</a>
		 	 	  	</li>
	 	 	  	</ul>
	 	 	</li>
	 	</ul>
	 	</nav>
		<div id="content">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  		<div class="container-fluid">
		  			<button type="button" id="sidebarCollapse" class="btn btn-info">
		  				<i class="fas fa-align-left"></i>	
		  			</button>
		  		</div>
		  	</nav>
		  	<div class="container" style="display: inline-flex;">
		  		<div style="width: 30%;">
			  		<img src="" style="width:300px;height: 300px; margin-left: 20px;"><br>
			  	</div>
			  	<table width="70%" style="margin-left: 20px; height: 200px; margin-top:30px;">
				  	<tr>
				  		<td width="10%">Name:</td>
				  		<td><?php echo $name ?></td>
			  		</tr>
			  		<tr>
			  			<td width="10%">Address::</td>
						<td><?php echo $address ?></td>
				  	</tr>
				  	<tr>
				  		<td width="10%">Gender:</td>
			  			<td><?php echo $gender ?></td>
			  		</tr>
			  		<tr>
						<td width="10%">Contact:</td>
				  		<td><?php echo $contact ?></td>
				  	</tr>
			  		<tr>
			  			<td width="10%">Birthday:</td>
			  			<td><?php echo $bday ?></td>
			  		</tr>
			  	</table>
		  	</div>
		  	<hr width="90%" style="border:1px solid black;">

		  	<div class=".container-fluid cc">
		    	<div class="table-responsive">
					<table id="employee_data" class="table table-fluid" width="100%">  
	                    <thead>  
	                        <tr>  
	                            <td>RESCUER NAME</td>  
	                            <td>VICTIM NAME</td>  
	                            <td>REQUEST DATE</td>  
	                            <td>TYPE of EMERGENCY</td>  
	                        </tr>  
	                    </thead>  
	                    <?php  
	                    while($row = mysqli_fetch_array($result))  
		                {  
		              		echo "<tr>";
								echo "<td class='align-middle'>"; echo $row["emp_fname"]." ".$row["emp_lname"]; echo "</td>";
								echo "<td class='align-middle'>"; echo $row["user_fname"]." ".$row["user_lname"]; echo "</td>";
								echo "<td class='align-middle'>"; echo $row["request_date"]; echo "</td>";
								echo "<td class='align-middle'>"; echo $row["emer_type"]; echo "</td>";
							echo "</tr>";
		                }  
		                ?>  
	                </table>  
				</div>
			</div>
		</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
$(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

</script>
<script>  
	$(document).ready(function(){  
    $('#employee_data').DataTable();  
 	});  
</script> 
</body>
</html>