<?php
include_once '../../dbconfig.php';

$id = $_POST['food_id'];
$query = "DELETE FROM foods WHERE food_id= $id";
$result = mysqli_query($connect, $query);

if ($connect->query($query) === TRUE) {
    echo "success";
} else
    echo "Error: " . $query . "<br>" . $connect->error;

$connect->close();