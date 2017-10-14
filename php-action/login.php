<?php
session_start();
include_once '../dbconfig.php';

$email = $_POST['email'];
$pass = $_POST['password'];

$query = "SELECT * FROM user WHERE email = '$email' and password = '$pass'";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    $_SESSION["email"] = $email;
    $_SESSION["password"] = $pass;
    echo "login success";
} else
    echo "Error: " . $query . "<br>" . $connect->error;

$connect->close();