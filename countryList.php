<?php 
require('database/config.php');

$sql_check = "SELECT * FROM `country`";
$result = mysqli_query($connection,$sql_check);
if($result->num_rows > 0){
    $response = array();
    while($data = $result->fetch_assoc())
    {
        $response[] = $data; 
    }
}
echo json_encode($response);