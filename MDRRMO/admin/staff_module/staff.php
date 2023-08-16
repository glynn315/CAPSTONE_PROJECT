<?php
	include('../../session.php');
	$link=mysqli_connect("localhost" , "root" , "");
	mysqli_select_db($link,"mdrrmodb");
	$date = date('Y-m-d');
	if (isset($_POST["btn-sub-info"])) {
		mysqli_query($link , "INSERT INTO emp_tbl(`emp_id`, `emp_fname`,`date_registered`, `emp_address`, `emp_gender`,`emp_contact`, `emp_lname`,`emp_bday`, `role_id`, `emp_status`, `emp_username`, `emp_password`) VALUES('','$_POST[txt1]','$date','$_POST[txt7]','$_POST[txt8]','$_POST[txt9]','$_POST[txt2]','$_POST[txt3]','$_POST[txt4]','ACTIVE','$_POST[txt5]','$_POST[txt6]')");
	}
	if (isset($_POST["del_data"])) {
		mysqli_query($link , "UPDATE emp_tbl SET emp_status='DELETED' WHERE emp_id = '$_POST[del_id]'");
	}
	$query ="SELECT emp_tbl.emp_id,emp_tbl.role_id,role_tbl.role_name,emp_tbl.emp_fname,emp_tbl.emp_lname,emp_tbl.emp_status,emp_tbl.date_registered
			 FROM emp_tbl 
			 INNER JOIN role_tbl 
			 ON emp_tbl.role_id = role_tbl.role_id WHERE emp_tbl.emp_status = 'ACCESSIBLE';";  
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
 	 		<li>
	 	 		<a href="../DASHBOARD/index.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
	 	 	</li>
	 	 	<li class="active">
	 	 		<a href="staff.php"><i class="bi bi-people"></i> Staff</a>
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
			    		
			    		<a href="#" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg2">+ Add User</a>
			    		<hr>
	                    <table id="employee_data" class="table table-fluid" width="100%">  
	                        <thead>  
	                            <tr> 
	                            	<td>#</td>  
	                                <td>Name</td>  
	                                <td>Date Employed</td>  
	                                <td>Account Status</td>  
	                                <td>Position</td>  
	                                <td width="100px"></td>  
	                            </tr>  
	                        </thead>  
	                        <?php  
	                          	while($row = mysqli_fetch_array($result))  
		                      	{  
		                        	echo "<tr>";
		                        		echo "<td class='align-middle'>"; echo $row["emp_id"]; echo "</td>";
								        echo "<td class='align-middle'>"; echo $row["emp_fname"]." ".$row["emp_lname"]; echo "</td>";
								        echo "<td class='align-middle'>"; echo $row["date_registered"]; echo "</td>";
								        echo "<td class='align-middle'>"; echo $row["emp_status"]; echo "</td>";
								        echo "<td class='align-middle'>"; echo $row["role_name"]; echo "</td>";
								        echo "<td align='center'><button class='btn btn-danger' data-toggle='modal' data-target='.bd-example-modal-lg1'><i class='fa fa-trash' aria-hidden='true'></i></button>";"</td>";
							        echo "</tr>";
		                        }  
		                    ?>  
	                    </table>  
	                </div>
            	</div>
            	<div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			  		<div class="modal-dialog modal-lg">
			    		<div class="modal-content" style="padding: 30px;">
			      			<form method="POST">
			      				<input type="text" name="del_id" id="del" hidden>
			      				<h3 align="center">ARE YOU SURE YOU WANT TO REMOVE</h3>
			      				<input type="text" name="" id="del_name" style="display: block; margin-left: auto;margin-right: auto;text-align: center; font-size: 30px; background: #FFF;color: #000; width: 100%;border: none;" disabled>
			      				<button type="submit" class="btn btn-primary" style="display: block; margin-left: auto;margin-right: auto; width: 200px;" name="del_data">CONFIRM</button>
			      			</form>
			    		</div>
			  		</div>
				</div>
			</div>
		    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			  		<div class="modal-dialog modal-lg">
			    		<div class="modal-content" style="padding: 30px;">
			      			<form method="POST">
			      				<h4 align="center">PERSONAL INFO</h4>
				      			
			      			</form>
			    		</div>
			  		</div>
				</div>
			</div>
			<div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			  		<div class="modal-dialog modal-lg">
			    		<div class="modal-content" style="padding: 30px;">
			      			<form method="POST">
			      				<h4 align="center">USER ACCOUNT INFORMATION</h4>
				      			<hr>
				      			<label>FIRST NAME</label>
				      			<input type="text" name="txt1" class="form-control" style="width:100%;" placeholder="FIRST NAME">
				      			<label>LAST NAME</label>
				      			<input type="text" name="txt2" class="form-control" style="width:100%;" placeholder="LAST NAME">
				      			<label>ADDRESS</label>
				      			<input type="text" name="txt7" class="form-control" style="width:100%;" placeholder="ADDRESS">
				      			<label>CONTACT NUMBER</label>
				      			<input type="text" name="txt9" class="form-control" style="width:100%;" placeholder="CONTACT NUMBER">
				      			<label>GENDER</label>
				      			<select name="txt8" class="form-control">
				      				<option value="MALE">MALE</option>
				      				<option value="FEMALE">FEMALE</option>
				      				<option value="OTHERS">OTHERS</option>
				      			</select>
				      			<label>BIRTHDAY</label>
				      			<input type="date" name="txt3" class="form-control" style="width:100%;" placeholder="">
				      			<label>POSITION</label>
				      			<select name="txt4" class="form-control" style="width:100%;" placeholder="">
									<?php
									$res=mysqli_query($link,"SELECT * from role_tbl");
									while($row=mysqli_fetch_array($res))
									{
									?>
										<option value="<?php echo $row['role_id']; ?>"><?php echo $row['role_name'] ; ?></option>
										<?php
									}
									?>
								</select>
								<label>USERNAME</label>
				      			<input type="text" name="txt5" class="form-control" style="width:100%;" placeholder="USERNAME">
				      			<label>PASSWORD</label>
				      			<input type="password" name="txt6" class="form-control" style="width:100%;" placeholder="PASSWORD">
				      			<input type="submit" name="btn-sub-info" value="SUBMIT FORM" class="btn btn-primary" style="display: block; margin-left: auto;margin-right: auto;margin-top: 10px;">
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
	        	document.getElementById("del").value = this.cells[0].innerHTML;
	        	document.getElementById("del_name").value = this.cells[1].innerHTML;
	       	};
	   	}
</script>
</body>
</html>