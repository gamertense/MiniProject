<?php
include_once '../dbconfig.php';

$id = $_POST['hidden_id'];
$query = "SELECT * FROM wishlist WHERE food_id= $id";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    echo "Already added to wishlist";
} else {
    $query = "INSERT INTO wishlist (food_id) VALUES ($id)";

    if ($connect->query($query) === TRUE) {
        echo "success-wishlist";
    } else
        echo "Error: " . $query . "<br>" . $connect->error;
}

$connect->close();