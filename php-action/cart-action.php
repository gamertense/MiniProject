<?php
include_once '../dbconfig.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] == "checkout") {
        echo "Echo from cart-action.php";
    } else if ($_POST['action'] == "updateQty")
        updateQuantity($connect);
    else {
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

function updateQuantity($connect)
{
    $number = count($_POST["foodID"]);

    if ($number > 0) {
        for ($i = 0; $i < $number; $i++) {
            $id = mysqli_real_escape_string($connect, $_POST["foodID"][$i]);
            $qty = mysqli_real_escape_string($connect, $_POST["quantity"][$i]);
            $sql = "UPDATE cart SET quantity = '$qty' WHERE food_id = '$id'";
            mysqli_query($connect, $sql);
        }

        if ($connect->query($sql) === TRUE) {
            echo "Successfully updated total price!";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
}