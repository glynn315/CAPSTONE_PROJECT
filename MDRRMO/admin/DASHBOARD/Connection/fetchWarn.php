<?php
	define('HOST','localhost');
	define('USER','root');
	define('PASS','');
	define('DB','mdrrmodb');

	 
	$con = mysqli_connect(HOST,USER,PASS,DB);
	$user  = $_GET['user'];
	 
	$query ="SELECT request_tbl.request_id,user_tbl.user_fname,user_tbl.user_lname,request_tbl.longitude,request_tbl.latitude,request_tbl.req_status,request_tbl.request_date,user_tbl.user_contact,request_tbl.image
		FROM user_tbl
		INNER JOIN request_tbl
		ON request_tbl.user_id = user_tbl.user_id WHERE user_username like '%$user%'";  


	//$query1 ="SELECT * FROM announcement_tbl WHERE announcement_status = 'ACTIVE' AND sender = 'ALL' OR sender = 'USERS'"; 

	$res = mysqli_query($con,$query);
	//$res1 = mysqli_query($con,$query1);
	$result = array();
	 
	while($row = mysqli_fetch_array($res)){
		array_push($result,array('id'=>$row[0],'name'=>$row[1],'name1'=>$row[2],'long'=>$row[3],'lat'=>$row[4],'stat'=>$row[5]));
	}
	// while($row = mysqli_fetch_array($res1)){
	// 	array_push($result,array('iid'=>$row[0],'announce'=>$row[1],'start'=>$row[3],'end'=>$row[4],'status'=>$row[7]));
	// }
	 
	echo json_encode(array("result"=>$result));
	 
	mysqli_close($con);
?>