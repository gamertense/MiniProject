<?php
include_once 'dbconfig.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] == "checkout") {
        echo "checkout";
    } else {
        $food_id = $_POST['food_id'];
        $sql = "DELETE FROM cart where food_id = $food_id";

        if ($connect->query($sql) === TRUE) {
            echo "The selected food has been removed from cart";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
} else
    echo "No data is received.";