<?php
	include('../../session.php');
	$link=mysqli_connect("localhost" , "root" , "");
	mysqli_select_db($link,"mdrrmodb");

	if (isset($_POST["btn-sub-info"])) {
		mysqli_query($link , "INSERT INTO emp_tbl(`emp_id`, `emp_fname`, `emp_lname`,`date_registered`, `role_id`, `emp_status`, `emp_username`, `emp_password`) VALUES('','$_POST[txt1]','$_POST[txt2]','$_POST[txt3]','$_POST[txt4]','ACTIVE','$_POST[txt5]','$_POST[txt6]')");
	}

	$query ="SELECT emp_tbl.emp_id,emp_tbl.role_id,role_tbl.role_name,emp_tbl.emp_fname,emp_tbl.emp_lname,emp_tbl.emp_status,emp_tbl.date_registered
			 FROM emp_tbl 
			 INNER JOIN role_tbl 
			 ON emp_tbl.role_id = role_tbl.role_id;";  
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
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
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
		    <div class="container-fluid cc">
		    	<div class="container-fluid cc">  
			    	<div class="table-responsive">  
	                     <table id="employee_data" class="table table-fluid" >  
	                          <thead>  
	                               <tr>  
	                                    <td>Name</td>  
	                                    <td>Date Employed</td>  
	                                    <td>Account Status</td>  
	                                    <td>Position</td>  
	                               </tr>  
	                          </thead>  
	                          <?php  
	                          while($row = mysqli_fetch_array($result))  
	                          {  
	                               echo '  
	                               <tr>  
	                                    <td>'.$row["emp_fname"]." ".$row["emp_lname"].'</td>  
	                                    <td>'.$row["date_registered"].'</td>  
	                                    <td>'.$row["emp_status"].'</td>  
	                                    <td>'.$row["role_name"].'</td> 
	                               </tr>  
	                               ';  
	                          }  
	                          ?>  
	                     </table>  
	                </div>
            	</div>
		    	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  	<div class="modal-dialog modal-dialog-centered" role="document">
			    	<div class="modal-content">
			      	<div class="modal-header">
			        	<h5 class="modal-title" id="exampleModalLongTitle">Add Users Information</h5>
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          		<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			    </div>
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