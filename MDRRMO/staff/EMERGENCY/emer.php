<?php
	include('../../session.php');
	$link=mysqli_connect("localhost" , "root" , "");
	mysqli_select_db($link,"mdrrmodb");
	$query ="SELECT request_tbl.request_id,user_tbl.user_fname,user_tbl.user_lname,request_tbl.longitude,request_tbl.latitude,request_tbl.req_status,request_tbl.request_date,user_tbl.user_contact,request_tbl.image
		FROM user_tbl
		INNER JOIN request_tbl
		ON request_tbl.user_id = user_tbl.user_id WHERE request_tbl.req_status = 'MONITORED';";  
 	$result = mysqli_query($link, $query);  
 	if (isset($_POST["sub_report"]))
		{
			mysqli_query($link , "UPDATE request_tbl SET req_status = 'DONE' , emer_report='$_POST[txtrep]' ,emp_id = '$login_session' , emer_type = '$_POST[type_emer]' WHERE request_id = '$_POST[IID]'");
			header("location:emer.php");
				
		}
		if (isset($_POST["input_report"]))
		{
			$date = date('Y-m-d');
			$filename="IMG".rand().".jpg";
			file_put_contents("../../uploads/".$filename,base64_decode($img));
			mysqli_query($link , "INSERT INTO request_tbl(`user_id`,`req_status`,`request_date`,`image`,`emp_id`,`emer_report`,`emer_type`,`longitude`,`latitude`) VALUES('1','DONE','$date','$filename','$login_session','$_POST[txtrep]','$_POST[type_emer]','0','0')"
		);
			header("location:emer.php");
				
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
	 	 	<li>
	 	 		<a href="../USERS/user.php"><i class="bi bi-person-lines-fill"></i> USERS LIST</a>
	 	 	</li>
	 	 	<li class="active">
	 	 		<a href="emer.php"><i class="bi bi-hospital"></i> EMERGENCY REPORTS</a>
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
		  	<button class="btn btn-primary" style="margin-bottom: 20px;" data-toggle='modal' data-target='.bd-example-modal-lg1'>+ Manual Monitoring</button>  
		    <table id="employee_data" class="table table-fluid" width="100%" align="center">  
		        <thead>  
		            <tr>  
		            	<td>ID</td>
		                <td>Name</td>  
		                <td>Contact Number</td>  
		                <td>Latitude</td>  
		                <td>Longitude</td> 
		                <td>Date</td> 
		                <td>Status</td> 
		                <td>Images</td> 
		                <td></td> 
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
								echo "<td width='10%'>../../../uploads/"; echo $row["image"]; echo "</td>";
								echo "<td><button class='btn btn-primary' data-toggle='modal' data-target='.bd-example-modal-lg'>VIEW</button>"; echo "</td>";
							echo "</tr>";
		                }  
		        ?>  
		    </table>  
		</div>
		</div>
		</div>
	</div>
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-lg">
    		<div class="modal-content" style="padding: 10px;">
      			<form method="POST">
      				<h4 align="center">Emergency Info</h4>
	      			<hr style="width: 100%;">
	      			<div class="form-group mb-3">
		                <img id="imms" class="form-control" style="width:50%;">
		            </div>
	      			<div class="form-group mb-3">
	      				<label>ID</label>
	                	<input type="text" id="txtid" placeholder="ID" name="IID" class="form-control">
	            	</div>
				    <div class="form-group mb-3">
				    	<label>NAME</label>
		                <input type="text" id="retname" placeholder="NAME" name="txtretID" class="form-control">
		            </div>
		            <div class="form-group mb-3">
		            	<label>STATUS</label>
		                <input type="text" id="retstat" name="z2" placeholder="STATUS"  class="form-control">
		            </div>
		            <div class="form-group mb-3">
		            	<label>TYPE OF EMERGENCY</label>
		                <select name="type_emer" class="form-control">
		                	<option value="Vehicular Accidents">Vehicular Accidents</option>
		                	<option value="Natural Calamity">Natural Calamity</option>
		                	<option value="Emergency Accidents">Emergency Accidents</option>
		                </select>
		            </div>
		            <div class="form-group mb-3">
		            	<label>TAKEN MEASURES</label>
		                <textarea cols="4" rows="4" class="form-control" name="txtrep"></textarea>
		            </div>
		            <div class="form-group mb-3">
		            	<input type="submit" name="sub_report" value="SUBMIT REPORT" class="btn btn-primary">
		            </div>
      			</form>
    		</div>
  		</div>
	</div>
	<div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-lg">
    		<div class="modal-content" style="padding: 10px;">
      			<form method="POST">
      				<h4 align="center">Emergency Input</h4>
	      			<hr style="width: 100%;">
	      			<div class="form-group mb-3">
		                <img id="imms" name="img" class="form-control" style="width:50%;">
		                <input type="file" name="" class="form-control">
		            </div>
		            <div class="form-group mb-3">
		            	<label>First Name</label>
		                <input type="text" name="fname" class="form-control" placeholder="First Name">
		            </div>
		            <div class="form-group mb-3">
		            	<label>Last Name</label>
		                <input type="text" name="lname" class="form-control" placeholder="Last Name">
		            </div>
		            <div class="form-group mb-3">
		            	<label>TYPE OF EMERGENCY</label>
		                <select name="type_emer" class="form-control">
		                	<option value="Vehicular Accidents">Vehicular Accidents</option>
		                	<option value="Natural Calamity">Natural Calamity</option>
		                	<option value="Emergency Accidents">Emergency Accidents</option>
		                </select>
		            </div>
		            <div class="form-group mb-3">
		            	<label>TAKEN MEASURES</label>
		                <textarea cols="4" rows="4" class="form-control" name="txtrep"></textarea>
		            </div>
		            <div class="form-group mb-3">
		            	<input type="submit" name="input_report" value="SUBMIT REPORT" class="btn btn-primary">
		            </div>
      			</form>
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
	        	document.getElementById("txtid").value = this.cells[0].innerHTML;
	        	document.getElementById("retname").value = this.cells[1].innerHTML;
	        	document.getElementById("retstat").value = this.cells[6].innerHTML;
	        	document.getElementById("imms").src = this.cells[7].innerHTML;
	        	// document.getElementById("retlong").value = this.cells[3].innerHTML;
	        	// document.getElementById("retcon").value = this.cells[3].innerHTML;
	        	// document.getElementById("retdate").value = this.cells[4].innerHTML;
	        	// document.getElementById("retstat").value = this.cells[6].innerHTML;
	        	// document.getElementById("imms").src = this.cells[7].innerHTML;
	       	};
	   	}
</script>
</body>
</html>