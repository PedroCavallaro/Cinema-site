<?php
include_once "./data.php";

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

session_destroy();
session_start();

$test = searchUser($username, $password);

if($test["username"] == "admin" and $test["password"] == "1234"){
    
    $_SESSION["logged"] = $username;
    header("location:../admin/addMovie.php");

}else if($test["username"] == $username and $test["password"] == $password){
    
    $_SESSION["logged"] = $username;
    header("location:../public/index.php");
}else{

    header("location:../public/loginPage.php");
}


?>