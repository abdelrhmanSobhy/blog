<?php 
session_start();

if(isset($_GET['lang'])){
  $lang = $_GET['lang'];
}

if($lang == 'ar'){
  $_SESSION['lang'] = 'ar';
} else {
  $_SESSION['lang'] = 'en';
}

header("Location:" . $_SERVER['HTTP_REFERER']);