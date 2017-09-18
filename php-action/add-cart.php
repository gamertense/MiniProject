<?php
include_once '../dbconfig.php';

$id = $_POST['hidden_id'];
$query = "SELECT * FROM `cart` WHERE food_id = '$id'";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $qty = $row['quantity'];
    $qty++;
    $sql = "UPDATE cart SET quantity = '$qty' WHERE food_id = '$id'";
} else {
    $sql = "INSERT INTO cart (food_id, quantity) VALUES ($id, 1)";
}

if ($connect->query($sql) === TRUE) {
    echo "Successfully added to cart";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

$connect->close();