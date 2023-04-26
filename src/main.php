<?php
include_once "./data.php";

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);


$test = searchUser($username, $password);

if($test["username"] == $username and $test["password"] == $password){
    setcookie("status", "logged", time()+(60*60*2));
    header("location:../public/index.php?username=$username");
    die();
}else{
    header("location:../public/loginPage.php");
}


?>