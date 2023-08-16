<?php
	include('../../session.php');
	$link=mysqli_connect("localhost" , "root" , "");
	mysqli_select_db($link,"mdrrmodb");
	$query ="SELECT request_tbl.request_id,user_tbl.user_fname,user_tbl.user_lname,request_tbl.longitude,request_tbl.latitude,request_tbl.req_status,request_tbl.request_date,user_tbl.user_contact,request_tbl.image
		FROM user_tbl
		INNER JOIN request_tbl
		ON request_tbl.user_id = user_tbl.user_id WHERE request_tbl.req_status != 'DONE';";  
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
	<link rel="stylesheet" href="../CSS/nav.css">
	<link rel="stylesheet" href="../CSS/style.css">
	<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

  	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
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
	 	 	<hr>
 	 		<li >
	 	 		<a href="../DASHBOARD/index.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
	 	 	</li>
	 	 	<li class="active">
	 	 		<a href="emergency.php"><i class="bi bi-hospital"></i> Emergency Occurance</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="taken.php"><i class="bi bi-subtract"></i> Action Taken</a>
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
					<table id="employee_data" class="table table-fluid" width="100%">
			        <thead>  
			            <tr>  
			            	<td>ID</td>
			                <td>Name</td>  
			                <td>Contact Number</td>  
			                <td>Latitude</td>  
			                <td>Longitude</td> 
			                <td>Date</td> 
			                <td>Status</td> 
			                <td width="5%"></td> 
			            </tr>  
			        </thead>  
			        <?php  
			            while($row = mysqli_fetch_array($result))  
			               {  
			                    echo "<tr>";
			                    	echo "<td class='align-middle'>"; echo $row["request_id"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["user_fname"]." ".$row["user_lname"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["user_contact"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["latitude"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["longitude"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["request_date"]; echo "</td>";
									echo "<td class='align-middle'>"; echo $row["req_status"]; echo "</td>";
									echo "<td class='align-middle'><img src='../../../uploads/"; echo $row["image"]; echo "'></td>";
								echo "</tr>";
			                }  
			        ?>  
			    </table>  
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