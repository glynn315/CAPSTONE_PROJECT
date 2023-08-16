<?php
	include('../../session.php');
	$link=mysqli_connect("localhost" , "root" , "");
	mysqli_select_db($link,"mdrrmodb");

	if (isset($_POST["add_submit"])) {
		$date = date('Y-m-d');
		mysqli_query($link , "INSERT INTO address_tbl VALUES('','$_POST[txt3]','$_POST[txt4]','$_POST[txt5]','$_POST[txt6]','$date')");
	}
	if (isset($_POST["evac_submit"])) {
		$date = date('Y-m-d');
		$image = addslashes(file_get_contents($_FILES['imim']['tmp_name']));
		mysqli_query($link , "INSERT INTO evac_tbl VALUES('','$image','$_POST[txtdate]','ACTIVE','$date','$name','$_POST[txt1]')");
	}
	if (isset($_POST["announce_submit"])) {
		$date1 =  strtotime($_POST["txt3"]);
		$date2 =  strtotime($_POST["txt4"]);

		$duration = ($date2 - $date1)/60/60/24;
		mysqli_query($link , "INSERT INTO announcement_tbl VALUES('','$_POST[txt1]','ACTIVE','$_POST[txt3]','$_POST[txt4]',$duration,'$login_session','$_POST[txttype]','$_POST[txtsend]')");
	}
	if (isset($_POST["JOB_submit"])) {
		mysqli_query($link , "INSERT INTO role_tbl VALUES('','$_POST[txt1]','$_POST[txt2]','$_POST[txt3]')");
	}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
  	<script src="http://code.jquery.com/jquery-latest.js"></script> 
	<title>MDRRMO</title>
		<script type="text/javascript"> 
			$(document) .ready(function(){ 
			$('.chkbx') .click(function(){ 
			var text= ""; 
			$('.chkbx:checked').each(function(){ 
				text+=$(this) .val() + ','; 
			}); 
			text=text.substring(0,text.length-1); 
			$('#selectedtext') .val(text); 
			var count = $("[type=' checkbox']:checked") .length; 
			$('#count').val($("[type='checkbox'] :checked") .length); 
				}); 
			}); 
		</script>
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
	 	 		<a href="other.php"><i class="bi bi-motherboard"></i> Others</a>
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
				<form method="POST">
					<div class="cons">
						<button type="submit" class="cards btn btn-primary" name="addressPage"><i class="fa fa-globe" aria-hidden="true"></i> Address</button>
						<button type="submit" class="cards btn btn-primary" name="evacPage"><i class="fa fa-ambulance" aria-hidden="true"></i>  Evacuations</button>
						<button type="submit" class="cards btn btn-primary" name="announcePage"><i class="fa fa-bullhorn" aria-hidden="true"></i> Announcement</button>
						<button type="submit" class="cards btn btn-primary" name="notifPage"><i class="fa fa-exclamation" aria-hidden="true"></i> Send Notifications</button>
					</div>
					<?php
					if (isset($_POST["notifPage"])) 
						{
							?>
							<div class=".container-fluid cc">
						    	<div class="table-responsive">
									<form method="POST">
										<a href="#" class="link" data-toggle="modal" data-target="#exampleModalCenter1">+ Add Evacuation Details</a>
										<table id="employee_data" class="table table-fluid">
											<thead>
												<tr>
													<td></td>
													<td>NAME</td>
													<td>STATUS</td>
												</tr>
											</thead>
											<?php
												$res = mysqli_query($link, "SELECT * from user_tbl where user_verification = 'VERIFIED'");
												while($row=mysqli_fetch_array($res))
												{
													echo "<tr>";
													echo "<td class='align-middle'><input type='checkbox' class='chkbx' value='"; echo $row["user_contact"]; echo "'></td>";
													echo "<td class='align-middle'>"; echo $row["user_lname"]." ".$row["user_fname"]; echo "</td>";
													echo "<td class='align-middle'>"; echo $row["user_status"]; echo "</td>";
													echo "</tr>";
												}
											?>
										</table>
											<input type='text' id='selectedtext' name="contact_num" class="form-control" style="width:90%;"></br> 
											<input type="submit" name="sendSMS" value="SEND Notification" class="btn btn-primary">
										
									</form>
								</div>
							</div>
						<?php
						}
						if (isset($_POST["evacPage"])) 
						{
							?>
							<div class=".container-fluid cc">
						    	<div class="table-responsive">
									<form method="POST">
										<a href="#" class="link" data-toggle="modal" data-target="#exampleModalCenter1">+ Add Evacuation Details</a>
										<table id="employee_data" class="table table-fluid">
											<thead>
												<tr>
													<td>#</td>
													<td>Municipality</td>
													<td>Added By</td>
													<td>Status</td>
													<td width="10%">Images</td>
												</tr>
											</thead>
											<?php
												$res = mysqli_query($link, "SELECT evac_tbl.added_by,evac_tbl.evac_id,evac_tbl.date_established,evac_tbl.evac_status,address_tbl.Purok,address_tbl.Barangay,evac_tbl.evac_image FROM evac_tbl INNER JOIN address_tbl ON evac_tbl.address_id = address_tbl.address_id;");
												while($row=mysqli_fetch_array($res))
												{
													echo "<tr>";
													echo "<td class='align-middle'>"; echo $row["evac_id"]; echo "</td>";
													echo "<td class='align-middle'>"; echo $row["Purok"]." ".$row["Barangay"]; echo "</td>";
													echo "<td class='align-middle'>"; echo $row["added_by"]; echo "</td>";
													echo "<td class='align-middle'>"; echo $row["evac_status"]; echo "</td>";
													echo '<td><img class="dis" src="data:image/jpeg;base64,'.base64_encode($row['evac_image'] ).'"/></td>';
													echo "</tr>";
												}
											?>
										</table>
									</form>
								</div>
							</div>
						<?php
						}
						if (isset($_POST["addressPage"])) {
							?>
							<div class=".container-fluid cc">
						    	<div class="table-responsive">
									<form method="POST">
										<a href="#" class="link" data-toggle="modal" data-target="#exampleModalCenter">+ Add Address Details</a>
										<table id="employee_data" class="table table-fluid">
											<thead>
												<tr>
													<td>#</td>
													<td>Purok</td>
													<td>barangay</td>
													<td>Municipality</td>
													<td>Population</td>
												</tr>
											</thead>
											<?php
												$res = mysqli_query($link, "SELECT * from address_tbl");
												while($row=mysqli_fetch_array($res))
												{
													echo "<tr>";
													echo "<td>"; echo $row["address_id"]; echo "</td>";
													echo "<td>"; echo $row["Purok"]; echo "</td>";
													echo "<td>"; echo $row["Barangay"]; echo "</td>";
													echo "<td>"; echo $row["municipality"]; echo "</td>";
													echo "<td>"; echo $row["add_population"]; echo "</td>";
													echo "</tr>";
												}
											?>
										</table>
									</form>
								</div>
							</div>
							<?php
						}
						if (isset($_POST["notificationPage"])) {
							?>
							<div class=".container-fluid cc">
						    	<div class="table-responsive">
									<form method="POST">
										<a href="#" class="link" data-toggle="modal" data-target="#exampleModalCenter">+ Add Notification</a>
										<table id="employee_data" class="table table-fluid">
											<thead>
												<tr>
													<td>#</td>
													<td>Announcement</td>
													<td>Duration</td>
													<td>Date Start</td>
													<td>Date Stop</td>
													<td>Status</td>
													<td>asd</td>
												</tr>
											</thead>
											<?php
												$res = mysqli_query($link, "SELECT * from announcement_tbl");
												while($row=mysqli_fetch_array($res))
												{
													echo "<tr>";
													echo "<td>"; echo $row["announce_id"]; echo "</td>";
													echo "<td>"; echo $row["announcement_name"]; echo "</td>";
													echo "<td>"; echo $row["announcement_duration"]; echo "</td>";
													echo "<td>"; echo $row["announcement_datestart"]; echo "</td>";
													echo "<td>"; echo $row["announcement_datestop"]; echo "</td>";
													echo "<td>"; echo $row["announcement_status"]; echo "</td>";
													echo "<td align='center'><button class='btn btn-primary'><i class='fa fa-wrench' aria-hidden='true'></i>s</button>";"</td>";
													echo "</tr>";
												}
											?>
										</table>
									</form>
								</div>
							</div>
							<?php
						}
						if (isset($_POST["announcePage"])) {
							?>
							<div class=".container-fluid cc">
						    	<div class="table-responsive">
									<form method="POST">
										<a href="#" class="link" data-toggle="modal" data-target="#exampleModalCenter2">+ Add ANNOUNCEMENT</a>
										<table id="employee_data" class="table table-fluid">
											<thead>
												<tr>
													<td>Announcement ID</td>
													<td>Name</td>
													<td>Status</td>
													<td>Date Start</td>
													<td>Date End</td>
													<td>Duration</td>
												</tr>
											</thead>
											<?php
												$res = mysqli_query($link, "SELECT * from announcement_tbl");
												while($row=mysqli_fetch_array($res))
												{
													echo "<tr>";
													echo "<td>"; echo $row["announce_id"]; echo "</td>";
													echo "<td>"; echo $row["announcement_name"]; echo "</td>";
													echo "<td>"; echo $row["announcement_status"]; echo "</td>";
													echo "<td>"; echo $row["announcement_datestart"]; echo "</td>";
													echo "<td>"; echo $row["announcement_datestop"]; echo "</td>";
													echo "<td>"; echo $row["announcement_duration"]; echo "</td>";
													echo "</tr>";
												}
											?>
										</table>
									</form>
								</div>
							</div>
							<?php
						}
						if (isset($_POST["jobDesc"])) {
							?>
							<div class=".container-fluid cc">
						    	<div class="table-responsive">
									<form method="POST">
										<a href="#" class="link" data-toggle="modal" data-target="#exampleModalCenter3">+ Add Job Description</a>
										<table id="employee_data" class="table table-fluid">
											<thead>
												<tr>
													<th>#</th>
													<th width="30%">Role Name</th>
													<th width="30%">Role Status</th>
													<th width="30%">Role Descriprion</th>
												</tr>
											</thead>
											<?php
												$res = mysqli_query($link, "SELECT * from role_tbl");
												while($row=mysqli_fetch_array($res))
												{
													echo "<tr>";
													echo "<td>"; echo $row["role_id"]; echo "</td>";
													echo "<td>"; echo $row["role_name"]; echo "</td>";
													echo "<td>"; echo $row["role_status"]; echo "</td>";
													echo "<td>"; echo $row["role_duty"]; echo "</td>";
													echo "</tr>";
												}
											?>
										</table>
									</form>
								</div>
							</div>
							<?php
						}
						if (isset($_POST["officerPage"])) {
							?>
							<div class=".container-fluid cc">
						    	<div class="table-responsive">
									<form method="POST">
										<a href="#" class="link" data-toggle="modal" data-target="#exampleModalCenter3">+ Add Officers</a>
										<table id="employee_data" class="table table-fluid">
											<thead>
												<tr>
													<th>#</th>
													<th width="30%">Role Name</th>
													<th width="30%">Role Status</th>
													<th width="30%">Role Descriprion</th>
												</tr>
											</thead>
											<?php
												$res = mysqli_query($link, "SELECT * from role_tbl");
												while($row=mysqli_fetch_array($res))
												{
													echo "<tr>";
													echo "<td>"; echo $row["role_id"]; echo "</td>";
													echo "<td>"; echo $row["role_name"]; echo "</td>";
													echo "<td>"; echo $row["role_status"]; echo "</td>";
													echo "<td>"; echo $row["role_duty"]; echo "</td>";
													echo "</tr>";
												}
											?>
										</table>
									</form>
								</div>
							</div>
							<?php
						}
					?>
				</form>
			</div>
		    
		</div>
	</div>
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<h5 class="modal-title" id="exampleModalLongTitle">Add Address Information</h5>
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        	<span aria-hidden="true">&times;</span>
			    	</button>
			   	</div>
			   	<form method="POST">
				    <div class="modal-body">
				        <table>
							<tr>
								<td>Purok:</td>
								<td><input type="text" name="txt3" placeholder="Purok"></td>
							</tr>
							<tr>
								<td>Barangay:</td>
								<td><input type="text" name="txt4" placeholder="Barangay"></td>
							</tr>
							<tr>
								<td>Municipality:</td>
								<td><input type="text" name="txt5" placeholder="Municipality"></td>
							</tr>
							<tr>
								<td>Population:</td>
								<td><input type="text" name="txt6" placeholder="Population"></td>
							</tr>
						</table>
			      	</div>
			      	<div class="modal-footer">
				       	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				       	<button type="submit" class="btn btn-primary" name="add_submit">Save changes</button>
				    </div>
			    </form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<h5 class="modal-title" id="exampleModalLongTitle">Add Users Information</h5>
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        	<span aria-hidden="true">&times;</span>
			    	</button>
			   	</div>
			   	<form name="form1" action="" method="post" enctype="multipart/form-data">
				    <div class="modal-body">
				        <table>
							<tr>
								<td>Evacuation Image:</td>
								<td><input type="file" name="imim" style="border:0px;"></td>
							</tr>
							<tr>
								<td>Date Establish:</td>
								<td><input type="date" name="txtdate" class="form-control"></td>
							</tr>
							<tr>
								<td>Select Address</td>
								<td>
								<select name="txt1">
									<?php
									$res=mysqli_query($link,"SELECT * from address_tbl");
									while($row=mysqli_fetch_array($res))
									{
									?>
										<option value="<?php echo $row['address_id']; ?>"><?php echo $row['Purok'] . ' ' .$row['Barangay' ] ; ?></option>
										<?php
									}
									?>
								</select>
							</td>
							</tr>
						</table>
			      	</div>
			      	<div class="modal-footer">
				       	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				       	<button type="submit" class="btn btn-primary" name="evac_submit">Save changes</button>
				    </div>
			    </form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<h5 class="modal-title" id="exampleModalLongTitle">Announcement Information</h5>
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        	<span aria-hidden="true">&times;</span>
			    	</button>
			   	</div>
			   	<form method="POST">
				    <div class="modal-body">
				        <table>
							<tr>
								<td>Announcement Name:</td>
								<td><input type="text" name="txt1" placeholder="Announcement Name"></td>
							</tr>
							<tr>
								<td>Date Start:</td>
								<td><input type="date" name="txt3"></td>
							</tr>
							<tr>
								<td>Date End:</td>
								<td><input type="date" name="txt4"></td>
							</tr>
							<tr>
								<td>Announcement Type </td>
								<td>
									<select name="txttype">
										<option value="MEETINGS">MEETINGS</option>
										<option value="SEMINARS">SEMINARS</option>
										<option value="OTHERS">OTHERS</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>SELECT SENDER</td>
								<td>
									<select name="txtsend">
										<?php
											$res=mysqli_query($link,"select * from role_tbl");
											while($row=mysqli_fetch_array($res))
											{
											?>
												<option value="<?php echo $row['role_name']; ?>"><?php echo $row['role_name']; ?></option>

													<?php
											}
										?>
										<option value="USERS">USERS</option>
										<option value="ALL">ALL</option>
									</select>
								</td>
							</tr>
						</table>
			      	</div>
			      	<div class="modal-footer">
				       	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				       	<button type="submit" class="btn btn-primary" name="announce_submit">Save changes</button>
				    </div>
			    </form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<h5 class="modal-title" id="exampleModalLongTitle">Announcement Information</h5>
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
				       	<button type="submit" class="btn btn-primary" name="JOB_submit">Save changes</button>
				    </div>
			    </form>
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

<script type="text/javascript"> 
	$(document) .ready(function(){ 
		$('.chkbx') .click(function(){ 
			var text= ""; 
			$('.chkbx:checked').each(function(){ 
				text+=$(this) .val() + ','; 
			}); 
			text=text.substring(0,text.length-1); 
			$('#selectedtext') .val(text); 
			var count = $("[type=' checkbox']:checked") .length; 
			$('#count').val($("[type='checkbox'] :checked") .length); 
		}); 
	}); 
</script>

<?php
											if (isset($_POST["sendSMS"])) {
												$ch = curl_init();
												$parameters = array(
													'apikey' => '77ed3208e811e69323cbbc15c9bcb84f',
													'number' => $_POST['contact_num'],
													'message' => 'SAMPLE Notifications',
													'sendername' => 'NMDRRMO'
												);
												curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
												curl_setopt( $ch, CURLOPT_POST, 1 );

												curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

												curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
												$output = curl_exec( $ch );
												curl_close ($ch);
												}
											?>
</body>
</html>