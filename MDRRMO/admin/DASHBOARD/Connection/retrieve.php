<?php
$host = "localhost";
$user = "root";
$password =  "";
$db = "awaw";
$con = mysqli_connect($host,$user,$password,$db);
$stmt = $con->prepare("SELECT rep from saw");

$stmt ->execute();
$stmt -> bind_result($title);

$products = array();

while($stmt ->fetch()){

    $temp = array();
	
	$temp= $title;

	array_push($products,$temp);
	}

	echo json_encode($products);

?>