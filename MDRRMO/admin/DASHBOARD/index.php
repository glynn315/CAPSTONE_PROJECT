<?php
	include('../../session.php');
	include('count.php');
	$link=mysqli_connect("localhost" , "root" , "");
	mysqli_select_db($link,"mdrrmodb");
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

	<script src="https://code.jquery.com/jquery-3.4.0.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<title>MDRRMO</title>
</head>
<body>
	<div class="wrapper">
 		<nav id="sidebar">
 	 	<ul class="list-unstyled components">
 	 		<img src="../../logo/logo.png" class="header">
 	 		<p><?php echo $name ?><br></p>
 	 		<li style="margin-top:-9%;">
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
 	 		<li class="active">
	 	 		<a href="index.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="../staff_module/staff.php"><i class="bi bi-people"></i> Staff</a>
	 	 	</li>
	 	 	<li>
	 	 		<a href="../users_module/users.php"><i class="bi bi-person-lines-fill"></i> Users List</a>
	 	 	</li>
 	 	 	<li>
 	 			<a href="../maintenance_module/maintenance.php"><i class="bi bi-gear-wide-connected"></i> Accessibility</a>
 	 		</li>
 	 		<li>
 	 			<a href="../emergency_module/emergency.php"><i class="bi bi-hospital"></i> Emergency Occurance</a>
 	 		</li>
 	 		<li>
	 	 		<a href="../monitoring/monitor.php"><i class="bi bi-tv-fill"></i> MONITORING</a>
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
		 	 	  	<li>
		 	 	  		<a href="../reports_module/rescue.php">Rescuers Report</a>
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
		  	<h3 style="margin-left:10px;">ADMIN DASHBOARD</h3>
		  	<hr width="99%">
		  	<div class="card" style="width: 25%;color:white;">
  				<div class="card-body bg-danger">
  					<div class="c-head">
  						<img src="../../logo/emergency.png" class="card-img" style="opacity: .5;">
  					</div>
    				<h5 class="card-title">Emergencies</h5>
    				<h3><?php echo $count ?></h3>
  				</div>
			</div>
			<div class="card" style="width: 20%;color:white;">
  				<div class="card-body bg-info">
  					<div class="c-head">
  						<img src="../../logo/user.png" class="card-img" style="opacity: .5;">
  					</div>
    				<h5 class="card-title">Users Count</h5>
    				<h3><?php echo $count2 ?></h3>
  				</div>
			</div>
			<div class="card" style="width: 20%;color:white;">
  				<div class="card-body bg-primary">
  					<div class="c-head">
  						<img src="../../logo/firefighter.png" class="card-img" style="opacity: .5;">
  					</div>
    				<h5 class="card-title">Responders</h5>
    				<h3><?php echo $count1 ?></h3>
  				</div>
			</div>
			<div class="card" style="width: 23%;color:white;">
  				<div class="card-body bg-warning">
  					<div class="c-head">
  						<img src="../../logo/warn.png" class="card-img" style="opacity: .5;">
  					</div>
    				<h5 class="card-title">ANNOUNCEMENT</h5>
    				<h3><?php echo $count3 ?></h3>
  				</div>
			</div>
			<!-- <div class="c-head">
				<h5 class="card-title"><i class="fa fa-bullhorn" aria-hidden="true"></i> Announcement</h5>
    			<hr>
    			<table width="100%" style="border:none;">   
		        <?php  
		            while($row = mysqli_fetch_array($result))  
		            {  
		                echo "<tr>";
		                    echo "<td>"; echo $row["announcement_name"]."<br>"." ".$row["announcement_datestart"]." - ".$row["announcement_datestop"]; echo "</td>";
						echo "</tr>";
		            }  
		        ?>  
		    	</table>
			</div> -->
			<br>
			<div class="card" style="width: 30%; border-radius:20px;">
				<div id="chart" style="width:95%;">
						
				</div>
			  	<div class="card-body bg-danger">
			    	<p align="center" style="color:white;">NATURAL CALAMITY </p>
			  	</div>
			</div>
			<div class="card" style="width: 30%; border-radius:20px;">
				<div id="chart1" style="width:95%;">
						
				</div>
			  	<div class="card-body bg-warning">
			    	<p align="center" style="color:white;">VEHICULAR ACCIDENTS </p>
			  	</div>
			</div>
			<div class="card " style="width: 30%; border-radius:20px;">
				<div id="chart2" style="width:95%;">
						
				</div>
			  	<div class="card-body bg-primary">
			    	<p align="center" style="color:white;">EMERGENCY ACCIDENTS </p>
			  	</div>
			</div>
		</div>
	</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    new Morris.Line({
        element : 'chart',
        data:[<?php echo $chart_data; ?>],
        xkey:'DATE',
        ykeys:['TYPE'],
        labels:['REQUEST DATE'],
        hideHover:'auto',
        stacked:true
    });
</script>
<script>
    new Morris.Line({
        element : 'chart1',
        data:[<?php echo $chart_data1; ?>],
        xkey:'DATE',
        ykeys:['TYPE'],
        labels:['REQUEST DATE'],
        hideHover:'auto',
        stacked:true
    });
</script>
<script>
    new Morris.Line({
        element : 'chart2',
        data:[<?php echo $chart_data2; ?>],
        xkey:'DATE',
        ykeys:['TYPE'],
        labels:['REQUEST DATE'],
        hideHover:'auto',
        stacked:true
    });
</script>
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