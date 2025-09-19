<?php 
require_once "../db/connection.php";
include "validate.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $errors = [] ; 

foreach ($validates as $validate_name => $validate_value){
  $value = filter_input(INPUT_POST , $validate_name , $validate_value['filter'] , ['options' => $validate_value['options'] ?? []]);

  if(empty($_POST[$validate_name])){
    $errors[$validate_name] = "You must fill $validate_name";
  } else if($value == false){
    $errors[$validate_name] = $validate_value['error'];
  }
}

if($errors){
  $_SESSION['errors'] = $errors ; 
  header("Location:../register.php");
  exit();
}

$stmt = $mysqli->prepare("INSERT INTO users (name, email, password , phone) VALUES (?, ?, ? , ?)");
if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}

$hashedPassword = password_hash($_POST['password'] , PASSWORD_DEFAULT);

$stmt->bind_param("ssss", $_POST['name'], $_POST['email'], $hashedPassword , $_POST['phone']);

if ($stmt->execute()) {
  $_SESSION["sucessRegister"] = "Sucess Register" ; 
  header("Location:../Login.php");
  exit();
} else {
    echo "Error: " . $stmt->error;
}

} else {
  header("Location:../register.php");
  exit();
}


?>