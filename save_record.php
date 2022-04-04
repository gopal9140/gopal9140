<?php
require('database/config.php');

 $name = $_POST['name'];
 $email = $_POST['email'];
 $dob = $_POST['dob'];
 $education = $_POST['education'];
 $address = $_POST['address'];
 $country = $_POST['country'];
 $state = $_POST['state'];
 $city = $_POST['city'];
 $zip_code = $_POST['pin_code'];
 $status = $_POST['status'];
 

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
 
if(
    isset($name) && isset($email) && isset($dob) && isset($education) 
    && isset($address) && isset($country) && isset($state) && isset($city)
    && isset($zip_code) && isset($status)
  ){
      $sql_check = "SELECT * FROM `dckap_employee` WHERE `email` = '$email'";
      $check = mysqli_query($connection,$sql_check);
      //print_r();
      if($check->num_rows > 0){
        echo 'already exist';
      }else{  
        if(isset($_FILES['image'])){
          $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','jfif');
        $path = 'uploads/'; 
        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $final_image = $img;
        if(in_array($ext, $valid_extensions)) 
            { 
                $path = $path.strtolower($final_image); 
                move_uploaded_file($tmp,$path);
            }
        } 
        $path = 'uploads/';
        $img = $_FILES['image']['name'];
        $final_image = $img;
        $path = $path.strtolower($final_image);
        $sql = "INSERT INTO `dckap_employee`(`name`, `email`, `address`, `date_of_birth`, `status`, `education`, `pin_code`, `profile_pic`, `country`, `state`, `city`) VALUES ('$name','$email','$address','$dob','$status','$education','$zip_code','$path','$country','$state','$city')";
        $inserted = mysqli_query($connection,$sql);
      
        if($inserted == 1){
            echo $inserted;
        }
      }
      
  }else{
    echo 'failed';
  }