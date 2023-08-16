<?php
	include('../../session.php');
	$link=mysqli_connect("localhost" , "root" , "");
	mysqli_select_db($link,"mdrrmodb");
	$query ="SELECT user_tbl.user_fname,user_tbl.user_lname,user_tbl.user_gender,user_tbl.user_contact,user_tbl.user_bday,user_tbl.date_registered,user_tbl.user_status,user_tbl.user_verification,address_tbl.Purok,address_tbl.Barangay,address_tbl.municipality FROM user_tbl INNER JOIN address_tbl ON user_tbl.address_id = address_tbl.address_id;";  
 	$result = mysqli_query($link, $query);  
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>

	<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>

  	<link rel="stylesheet" href="../CSS/nav.css">
	<link rel="stylesheet" href="../CSS/style.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<title>MDRRMO</title>
</head>
<body>
	<div class="wrapper">
 		<nav id="sidebar">
 	 	<ul class="list-unstyled components">
 	 		<img src="../../logo/logo.png" class="header">
 	 		<p><?php echo $name ?><br>
 	 		<li style="margin-top:-9%;">
	 	 		<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><img src="../../logo/a.png" style="width:10px;"> ACTIVE</a>
	 	 		<ul class="collapse list-unstyled" id="pageSubmenu">
	 	 			<li>
	 	 				<a href="../staff_module/staff.php">Account Settings</a>
	 	 			</li>
	 	 			<li>
	 	 				<a href="../DASHBOARD/logout.php">Logout</a>
	 	 			</li>
	 	 		</ul>
	 	 	</li>
 	 		</p>
 	 		<hr>
 	 		<li>
	 	 		<a href="../DASHBOARD/index.php"><i class="bi bi-speedometer2"></i> DASHBOARD</a>
	 	 	</li>
	 	 	<li class="active">
	 	 		<a href="user.php"><i class="bi bi-person-lines-fill"></i> USERS LIST</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="../EMERGENCY/emer.php"><i class="bi bi-hospital"></i> EMERGENCY REPORTS</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="../MONITORING/monitor.php"><i class="bi bi-tv-fill"></i> MONITORING</a>
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
		  	<div class="table-responsive cen">  
		    <table id="employee_data" class="table table-fluid" width="100%" align="center">  
		        <thead>  
		            <tr>  
		                <td>Name</td>    
		                <td>Address</td>  
		                <td>Gender</td> 
		                <td>Contact Number</td>
		                <td>Birthday</td> 
		                <td>Date Registered</td> 
		                <td>Status</td> 
		                <td>Verified</td>
		                <td></td> 
		            </tr>  
		        </thead>  
		        <?php  
		            while($row = mysqli_fetch_array($result))  
		           	{  
		                echo "<tr>";
							echo "<td class='align-middle'>"; echo $row["user_fname"]." ".$row["user_lname"]; echo "</td>";
							echo "<td class='align-middle'>"; echo $row["Purok"]." ".$row["Barangay"]. " " .$row["municipality"]; echo "</td>";
							echo "<td class='align-middle'>"; echo $row["user_gender"]; echo "</td>";
							echo "<td class='align-middle'>"; echo $row["user_contact"]; echo "</td>";
							echo "<td class='align-middle'>"; echo $row["user_bday"]; echo "</td>";
							echo "<td class='align-middle'>"; echo $row["date_registered"]; echo "</td>";
							echo "<td class='align-middle'>"; echo $row["user_status"]; echo "</td>";
							echo "<td class='align-middle'>"; echo $row["user_verification"]; echo "</td>";
							echo "<td><button class='btn btn-primary' data-toggle='modal' data-target='.bd-example-modal-lg'>VIEW</button>"; echo "</td>";
						echo "</tr>";
		            }  
		        ?>  
		    </table>  
		</div>
		</div>
	</div>
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-lg">
    		<div class="modal-content" style="padding: 10px;">
      			<h4>Users INFORMATION</h4>
      			<hr style="width: 100%;">
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
<script type="text/javascript">
   	var table = document.getElementById('employee_data');     
	   	for(var i = 1; i < table.rows.length; i++)
	   	{
	       	table.rows[i].onclick = function()
	       	{
	        	document.getElementById("retname").value = this.cells[0].innerHTML;
	        	document.getElementById("retadd").value = this.cells[1].innerHTML;
	        	document.getElementById("retlong").value = this.cells[3].innerHTML;
	        	document.getElementById("retlat").value = this.cells[2].innerHTML;
	        	document.getElementById("retdate").value = this.cells[4].innerHTML;
	        	document.getElementById("retstat").value = this.cells[5].innerHTML;
	        	document.getElementById("imms").src = this.cells[6].innerHTML;
	       	};
	   	}
</script>
</body>
</html>