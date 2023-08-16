<?php
	define('HOST','localhost');
	define('USER','root');
	define('PASS','');
	define('DB','mdrrmodb');

	 
	$con = mysqli_connect(HOST,USER,PASS,DB);
	 
	$query ="SELECT * FROM announcement_tbl WHERE announcement_status = 'ACTIVE' AND sender = 'ALL' OR sender = 'USERS'"; 
	 
	$res = mysqli_query($con,$query);
	 
	$result = array();
	 
	while($row = mysqli_fetch_array($res)){
		array_push($result,array('iid'=>$row[0],'announce'=>$row[1],'start'=>$row[3],'end'=>$row[4],'status'=>$row[7]));
	}
	 
	echo json_encode(array("result"=>$result));
	 
	mysqli_close($con);
?>