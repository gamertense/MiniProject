<?php
session_start();
include_once '../dbconfig.php';

$user_id = $_SESSION["user_id"];
$password = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];

$sql = "UPDATE customer SET password='$password', name='$name', email='$email', address='$address' WHERE cu_id = $user_id";

if ($connect->query($sql) === TRUE) {
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}