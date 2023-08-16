<?php
if(isset($_POST['email']) && isset($_POST['password'])){
    require_once "connect.php";
    require_once "validate.php";
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $sql = "select * from user_tbl where user_username='$email' and user_password='$password'";

    $result = $con->query($sql);
    if($result->num_rows > 0){
        echo "success";
    } else{
        echo "failure";
    }
}   
?>