<?php
	define('HOST','localhost');
	define('USER','root');
	define('PASS','');
	define('DB','mdrrmodb');

	 
	$con = mysqli_connect(HOST,USER,PASS,DB);
	$user  = $_GET['user'];
	 
	$sql = "SELECT user_tbl.user_id,user_tbl.user_fname,user_tbl.user_lname,user_tbl.user_gender,user_tbl.user_contact,user_tbl.user_bday,user_tbl.user_status,user_tbl.user_verification,address_tbl.purok,address_tbl.barangay,user_tbl.user_username,user_tbl.user_password
		FROM user_tbl
		INNER JOIN address_tbl
		ON address_tbl.address_id = user_tbl.address_id WHERE user_username like '%$user%'";
	 
	$res = mysqli_query($con,$sql);
	 
	$result = array();
	 
	while($row = mysqli_fetch_array($res)){
		array_push($result,array('id'=>$row[0],'name'=>$row[1],'name1'=>$row[2],'gender'=>$row[3],'contact'=>$row[4],'bday'=>$row[5],'status'=>$row[6],'verif'=>$row[7],'purok'=>$row[8],'barangay'=>$row[9]));
	}
	 
	echo json_encode(array("result"=>$result));
	 
	mysqli_close($con);
?>