<?php
include_once 'dbconfig.php';

$food_id = $_POST['food_id'];
$sql = "DELETE FROM cart where food_id = $food_id";

if ($connect->query($sql) === TRUE) {
    echo "Your food has been removed from cart";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}