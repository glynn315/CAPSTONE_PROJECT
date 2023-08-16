<?php
require_once "connect.php";
$sql = "SELECT address_id, Purok, Barangay from address_tbl";
if(!$con->query($sql))
    {
        echo "Error in executing query.";
    }
    else
    {
        $result = $con->query($sql);
        if($result->num_rows > 0){
            $return_arr['adresses'] = array();
            while($row = $result->fetch_array()){
                array_push($return_arr['adresses'], array(
                    'address_id'=>$row['address_id'],
                    'address'=>$row['Purok']. " " .$row['Barangay']
                ));
            }
            echo json_encode($return_arr);
        }
    }
?>