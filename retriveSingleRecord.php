<?php 
require('database/config.php');
$data = stripcslashes(file_get_contents("php://input"));
$myData = json_decode($data,true);
$id = $myData['id'];

$sql_check = "SELECT dckap_employee.`unique_id`, country.`country_name` as `country`,states.`name` as `state`,city.`name` as `city`,dckap_employee.`name`,dckap_employee.`email`,dckap_employee.`address`,dckap_employee.`date_of_birth`,dckap_employee.`status`,dckap_employee.`education`,dckap_employee.`pin_code`,dckap_employee.`profile_pic`,dckap_employee.`country` as 	`country_id`,dckap_employee.`state` as `state_id`,dckap_employee.`city` as `city_id`,dckap_employee.`education`
FROM dckap_employee
INNER JOIN country
ON dckap_employee.country=country.id 
INNER JOIN states
ON dckap_employee.state=states.id 
INNER JOIN city
ON dckap_employee.city=city.id WHERE dckap_employee.`unique_id` = '$id'";
$result = mysqli_query($connection,$sql_check);
if($result->num_rows > 0){
    $response = array();
    while($data = $result->fetch_assoc())
    {
        $response[] = $data; 
    }
}
echo json_encode($response);