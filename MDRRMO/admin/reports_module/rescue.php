<?php
	include('../../session.php');
	$link=mysqli_connect("localhost" , "root" , "");
	mysqli_select_db($link,"mdrrmodb");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rescue REPORTS</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>

	<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>

  	<link rel="stylesheet" href="../CSS/style.css">
	<link rel="stylesheet" href="../CSS/print.css" media="print">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light" style="background: #004e99;">
		<img src="../../logo/logo.png" width="5%">
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
  		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    		<div class="navbar-nav">
      			<a class="nav-item nav-link" href="../DASHBOARD/index.php" style="color: #fff;">DASHBOARD</a>
    		</div>
  		</div>
	</nav>
	<div>
		<h3 align="center" style="margin-top:50px;">NATURAL CALAMITY REPORT</h3>
		<h6 align="center">NORALA MUNICIPAL DISASTER RISK REDUCTION MANAGEMENT OFFICE</h6>
		<p align="center">NORALA SOUTH COTABATO</p>
		<p align="center">DATE RANGE:</p>
		<table class="table" style="width:80%;text-align: left;margin-top: 50px;" align="center">
	  		<thead style="background:#004e99;" id="heads">
	    		<tr>
	      			<th scope="col">NAME</th>
	      			<th scope="col">DATE</th>
				    <th scope="col">ACTION TAKEN</th>
				    <th scope="col">EMERGENCY</th>
	    		</tr>
	  		</thead>
	  		<tbody>
	  			<?php
				$res = mysqli_query($link, "SELECT request_tbl.request_id,user_tbl.user_fname,user_tbl.user_lname,request_tbl.longitude,request_tbl.latitude,request_tbl.req_status,request_tbl.request_date,user_tbl.user_contact,request_tbl.emer_report,request_tbl.emer_type FROM user_tbl INNER JOIN request_tbl ON request_tbl.user_id = user_tbl.user_id WHERE request_tbl.req_status = 'DONE';");
				while($row=mysqli_fetch_array($res))
				{
					echo "<tr>";
					echo "<td>"; echo $row["user_fname"] . ' ' .$row["user_lname"]; echo "</td>";
					echo "<td>"; echo $row["request_date"]; echo "</td>";
					echo "<td>"; echo $row["emer_report"]; echo "</td>";
					echo "<td>"; echo $row["emer_type"]; echo "</td>";
					echo "</tr>";
				}
				?>
	  		</tbody>
  		</table>
	</div>
	<div class="text-center">
        <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
    </div>
</body>
</html>