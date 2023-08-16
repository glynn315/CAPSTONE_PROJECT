<?php
	include('../../session.php');
	$link=mysqli_connect("localhost" , "root" , "");
	mysqli_select_db($link,"mdrrmodb");

	if (isset($_POST["job_submit"])) {
		mysqli_query($link , "INSERT INTO role_tbl VALUES('','$_POST[txt1]','$_POST[txt2]','$_POST[txt3]')");
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
	<title>MDRRMO</title>
</head>
<body>
	<div class="wrapper">
 		<nav id="sidebar">
		 	<div class="sidebar-header">
		 		<img src="../logo/logo.png">
		 	</div>
 	 	<ul class="list-unstyled components">
 	 		<p>MDRRMO Staff Info</p>
 	 		<li>
	 	 		<a href="../index.php">Dashboard</a>
	 	 	</li>
	 	 	<li  class="active">
	 	 		<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Staff</a>
	 	 		<ul class="collapse list-unstyled" id="pageSubmenu">
	 	 			<li>
	 	 				<a href="staff.php">Add Staff</a>
	 	 			</li>
	 	 			<li>
	 	 				<a href="staff_list.php">Staff List</a>
	 	 			</li>
	 	 		</ul>
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
		    	<a href="#" class="link" data-toggle="modal" data-target="#exampleModalCenter">+ Add Job Description</a>
		    	<table class="table table-striped table-dark">
					<tr>
						<th>#</th>
						<th>Role Name</th>
						<th>Role Status</th>
						<th>Role Descriprion</th>
					</tr>
					<?php
						$res = mysqli_query($link, "SELECT * from role_tbl ");
						while($row=mysqli_fetch_array($res))
						{
							echo "<tr>";
							echo "<td>"; echo $row["role_id"]; echo "</td>";
							echo "<td>"; echo $row["role_name"]; echo "</td>";
							echo "<td>"; echo $row["role_status"]; echo "</td>";
							echo "<td style='width:60%'>"; echo $row["role_duty"]; echo "</td>";
							echo "</tr>";
						}
					?>
				</table>
		    	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  	<div class="modal-dialog modal-dialog-centered" role="document">
			    	<div class="modal-content">
			      	<div class="modal-header">
			        	<h5 class="modal-title" id="exampleModalLongTitle">Add Users Information</h5>
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          		<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			      	<form method="POST">
				      	<div class="modal-body">
					        <table>
								<tr>
									<td>Job Name:</td>
									<td><input type="text" name="txt1" placeholder="Role Name"></td>
								</tr>
								<tr>
									<td>Job Status:</td>
									<td><select name="txt2">
											<option>Active</option>
											<option>Non-Active</option>
											<option>Archives</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Job Duty:</td>
									<td><textarea placeholder="Job Description" name="txt3"></textarea></td>
								</tr>
							</table>
				      	</div>
				      	<div class="modal-footer">
				        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        	<button type="submit" class="btn btn-primary" name="job_submit">Save changes</button>
				      	</div>
			      	</form>
			    </div>
			</div>
		    
		</div>
	</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>

$(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

</script>

</body>
</html>