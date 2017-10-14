<?php
session_start();
include_once '../dbconfig.php';

$email = $_POST['email'];
$pass = $_POST['password'];

$query = "SELECT * FROM user WHERE email = '$email' and password = '$pass'";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $_SESSION["user_id"] = $row['user_id'];
    $_SESSION["name"] = $row['name'];
    $_SESSION["email"] = $row['email'];
    echo "login success";
} else
    echo "Error: " . $query . "<br>" . $connect->error;

$connect->close();