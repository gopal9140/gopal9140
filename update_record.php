<?php
require('database/config.php');
// print_r($_FILES['image-edit']);
// exit;
 $unique_id = $_POST['unique_id'];   
 $name = $_POST['name_edit'];
 $email = $_POST['email_edit'];
 $dob = $_POST['dob_edit'];
 $education = $_POST['education_edit'];
 $address = $_POST['address_edit'];
 $country = $_POST['country_edit'];
 $state = $_POST['state_edit'];
 $city = $_POST['city_edit'];
 $zip_code = $_POST['pin_code_edit'];
 $status = $_POST['status_edit'];
 

//  echo $name."<br>";
//  echo $email."<br>";
//  echo $dob."<br>";
//  echo $education."<br>";
//  echo $address."<br>";
//  echo $country."<br>";
//  echo $state."<br>";
//  echo $city."<br>";
//  echo $zip_code."<br>";
//  echo $status."<br>";
 
if(isset($unique_id)){
      $sql_check = "SELECT * FROM `dckap_employee` WHERE `unique_id` = '$unique_id'";
      $check = mysqli_query($connection,$sql_check);
      if($check->num_rows > 0){
        $image='';
        while($data = $check->fetch_assoc())
        {
            $image = $data['profile_pic']; 
        }
        //print_r($_FILES);
        if(isset($_FILES['image-edit'])){
            //echo 'dasd';
          $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','jfif');
          $path = 'uploads/'; 
          $img = $_FILES['image-edit']['name'];
          $tmp = $_FILES['image-edit']['tmp_name'];
          $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
          $final_image = $img;
          if(in_array($ext, $valid_extensions)) 
              { 
                  $path = $path.strtolower($final_image); 
                  move_uploaded_file($tmp,$path);
              }
          } 
            $path = 'uploads/';
            $img = $_FILES['image-edit']['name'];
            $final_image = $img;
            if($img){
                $path = $path.strtolower($final_image);
            }else{
                $path = $image;
            }
            
            $sql = "UPDATE `dckap_employee` SET `name`='$name',`email`='$email',`address`='$address',`date_of_birth`='$dob',`status`='$status',`education`='$education',`pin_code`='$zip_code',`profile_pic`='$path',`country`='$country',`state`='$state',`city`='$city' WHERE `unique_id` = '$unique_id'";
            $update = mysqli_query($connection,$sql);
            if($update){
                echo 'updated';
            }
      }
      
  }else{
    echo 'failed';
  }