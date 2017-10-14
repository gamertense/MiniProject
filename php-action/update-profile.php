<?php
include_once '../dbconfig.php';

$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];

$sql = "UPDATE user SET username='$username', password='$password', name='$name', email='$email', address='$address' WHERE user_id = 1";

if ($connect->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}