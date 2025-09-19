<?php

require_once "../db/connection.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
  $id = $_GET['id'];
  $deleteQuery = $mysqli->prepare("DELETE FROM posts WHERE id = ?");
  $deleteQuery->bind_param("i" , $id);
  
  if($deleteQuery->execute()){
    $_SESSION['successDelete'] = "The post was deleted successfully... ";
    header("Location:../index.php");
    exit();
  } else {
    echo "Sorry , we found an Error : " . $deleteQuery->error ;   
  }

}
