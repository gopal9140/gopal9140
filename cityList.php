<?php 
require('database/config.php');
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql_check = "SELECT * FROM `city` WHERE `state_id` = '$id'";
    $result = mysqli_query($connection,$sql_check);
    if($result->num_rows > 0){
        $response = array();
        while($data = $result->fetch_assoc())
        {
            $response[] = $data; 
        }
    }
    echo json_encode($response);
}

