<?php
include_once 'dbconfig.php';

$id = $_POST['hidden_id'];
$sql = "INSERT INTO cart (food_id) VALUES ($id)";

if ($connect->query($sql) === TRUE) {
    echo "Successfully added to cart";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

$connect->close();