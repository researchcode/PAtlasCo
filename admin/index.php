<?php
// Read the JSON file 
$json = file_get_contents('../vars.json');
  
// Decode the JSON file
$json_data = json_decode($json,true);
  
if($json_data['installed'] == 0){
    header('Location: ../install.php');
}else{
header ('Location:login.php');
}
?>