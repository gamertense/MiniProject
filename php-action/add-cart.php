<?php
session_start();
include_once '../dbconfig.php';

$cu_id = $_SESSION["cu_id"];
$food_id = $_POST['hidden_id'];
$query = "SELECT * FROM foods WHERE food_id = '$food_id' and out_stock = 1";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    echo "out of stock";
    return;
}

$query = "SELECT * FROM `cart` WHERE cu_id = '$cu_id' and food_id = '$food_id'";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $qty = $row['quantity'];
    $qty++;
    $sql = "UPDATE cart SET quantity = '$qty' WHERE cu_id = '$cu_id'";
} else {
    $sql = "INSERT INTO cart (cu_id, food_id, quantity) VALUES ($cu_id, $food_id, 1)";
}

if ($connect->query($sql) === TRUE) {
    echo "success-cart";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

$connect->close();