<?php
session_start();
include_once '../dbconfig.php';

$password = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];

$sql = "UPDATE user SET password='$password', name='$name', email='$email', address='$address' WHERE user_id = 1";

if ($connect->query($sql) === TRUE) {
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}