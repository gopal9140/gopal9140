<?php

require('database/config.php');
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql_check = "DELETE FROM `dckap_employee` where `unique_id` = $id";
    $delete = mysqli_query($connection,$sql_check);
    if($delete){
        echo 'deleted';
    }
}
