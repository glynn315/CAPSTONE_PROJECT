<?php
include('../../session.php');
$link=mysqli_connect("localhost" , "root" , "");
	mysqli_select_db($link,"mdrrmodb");
	$query ="SELECT request_tbl.request_id,user_tbl.user_fname,user_tbl.user_lname,request_tbl.longitude,request_tbl.latitude,request_tbl.req_status,request_tbl.request_date,user_tbl.user_contact,request_tbl.image
		FROM user_tbl
		INNER JOIN request_tbl
		ON request_tbl.user_id = user_tbl.user_id WHERE request_tbl.req_status != 'DONE' AND request_tbl.req_status != 'DENIED';";  
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

	<link rel="stylesheet" type="text/css" href="../CSS/style.css">
	<title>ADMIN Monitoring</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<img src="../../logo/logo.png" width="7%">
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
  		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    		<div class="navbar-nav">
      			<a class="nav-item nav-link" href="../DASHBOARD/index.php">DASHBOARD</a>
    		</div>
  		</div>
	</nav>
	<div class="container-fluid">  
		<button onclick="openFullscreen();" class="btn btn-primary" sty>FULL SCREEN MODE</button>
		<form method="POST">
			<div class="view1" style="float:left;">
			<?php
		    if (isset($_POST["txtretID"]))
			{
				$latitude = $_POST["z1"];
				$longitude = $_POST["z2"];
				?>

					<iframe width="100%" height="650" border="" src="https://maps.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&output=embed" id="fill"></iframe>

				<?php
				mysqli_query($link , "UPDATE request_tbl SET req_status='$_POST[stat]' WHERE request_tbl.request_id = '$_POST[IID]'");
				
			}
		?>
		</div>
		<div class="view" style="height:650px;" style="border: none;">
		    <div class="form-group mb-3">
                <img id="imms" class="form-control" height="250px">
            </div>
            <div class="form-group mb-3">
                <input type="text" id="txtid" placeholder="ID" name="IID" class="form-control">
            </div>
		    <div class="form-group mb-3">
                <input type="text" id="retname" placeholder="NAME" name="txtretID" class="form-control">
            </div>
            <div class="form-group mb-3">
                <input type="text" id="retlong" name="z2" placeholder="LONGITUDE"  class="form-control">
            </div>
            <div class="form-group mb-3">
                <input type="text" id="retlat" name="z1" placeholder="LATITUDE"  class="form-control">
            </div>
            <div class="form-group mb-3">
                <input type="text" id="connum" name="c1" placeholder="CONTACT NUMBER"  class="form-control">
            </div>
            <div class="form-group mb-3">
                <select name="stat">
                	<option value="DENIED">DENIED</option>
                	<option value="MONITORED">MONITORED</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <input type="submit" value="Locate" name="submit_coordinates" class="form-control btn btn-primary">
            </div>

		</div>
		
		
		<div class="table-responsive" style="width: 100%;">  
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
		                <td width="1px">Images</td> 
		            </tr>  
		        </thead>  
		        <?php  
		            while($row = mysqli_fetch_array($result))  
		               {  
		                    echo "<tr>";
		                    	echo "<td>"; echo $row["request_id"]; echo "</td>";
								echo "<td>"; echo $row["user_fname"]." ".$row["user_lname"]; echo "</td>";
								echo "<td>"; echo $row["user_contact"]; echo "</td>";
								echo "<td>"; echo $row["latitude"]; echo "</td>";
								echo "<td>"; echo $row["longitude"]; echo "</td>";
								echo "<td>"; echo $row["request_date"]; echo "</td>";
								echo "<td>"; echo $row["req_status"]; echo "</td>";
								echo "<td width='10%' style='visibility:hidden;'>../../../uploads/"; echo $row["image"]; echo "</td>";
							echo "</tr>";
		                }  
		        ?>  
		    </table>  
		</div>
		</form>	
	</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
	        	document.getElementById("retlong").value = this.cells[4].innerHTML;
	        	document.getElementById("retlat").value = this.cells[3].innerHTML;
	        	document.getElementById("connum").value = this.cells[2].innerHTML;
	        	document.getElementById("imms").src = this.cells[7].innerHTML;
	       	};
	   	}
</script>
<script>
var elem = document.getElementById("fill");
	function openFullscreen() {
  		if (elem.requestFullscreen) {
    		elem.requestFullscreen();
  		} 
  		else if (elem.webkitRequestFullscreen) { /* Safari */
    		elem.webkitRequestFullscreen();
  		} 
  		else if (elem.msRequestFullscreen) { /* IE11 */
    		elem.msRequestFullscreen();
  		}
	}
</script>
<?php
if (isset($_POST["submit_coordinates"])) {
	$message = "Greetings FROM NMDRRMO your request has been " . $_POST['stat'] . " by the System.";
	$ch = curl_init();
	$parameters = array(
		'apikey' => '77ed3208e811e69323cbbc15c9bcb84f',
		'number' => $_POST['c1'],
		'message' => $message,
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