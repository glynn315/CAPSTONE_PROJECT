<?php
$link=mysqli_connect("localhost" , "root" , "");
    mysqli_select_db($link,"mdrrmodb");

$query ="SELECT * FROM evac_tbl WHERE evac_id = '0'";  
$result = mysqli_query($link, $query);  
if (isset($_POST["btnsearch"])) {
    $query ="SELECT address_tbl.Purok,address_tbl.Barangay,evac_tbl.evac_image FROM evac_tbl INNER JOIN address_tbl ON evac_tbl.address_id = address_tbl.address_id WHERE address_tbl.address_id = '$_POST[txt1]'";  
    $result = mysqli_query($link, $query);  
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
    <style type="text/css">
        img
        {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 80%;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <form method="POST">
            <form name="form1" action="" method="post" enctype="multipart/form-data">
                <select name="txt1" class="form-control">
                    <?php
                    $res=mysqli_query($link,"SELECT address_tbl.address_id,address_tbl.address_id,address_tbl.Purok,address_tbl.Barangay,evac_tbl.evac_image FROM evac_tbl INNER JOIN address_tbl ON evac_tbl.address_id = address_tbl.address_id;");
                    while($row=mysqli_fetch_array($res))
                    {
                    ?>
                        <option value="<?php echo $row['address_id']; ?>"><?php echo $row['Purok'] . ' ' .$row['Barangay' ] ; ?></option>
                        <?php
                    }
                    ?>
                </select><br>
                <input type="submit" name="btnsearch" value="SELECT" class="form-control btn btn-primary">
            </form>
            
        </form>
    </div>
    <table class="table table-fluid" width="100%">
        <thead>  
            <tr>  
                <td></td> 
            </tr>  
        </thead>  
        <?php  
        while($row = mysqli_fetch_array($result))  
        {  
            echo "<tr>";
                echo'<td><img src="data:image/jpeg;base64,'.base64_encode($row['evac_image'] ).'"/></td>';
            echo "</tr>";
        }  
        ?>  
    </table>  

</body>
</html>