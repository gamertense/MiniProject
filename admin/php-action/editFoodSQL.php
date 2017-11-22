<?php
include_once '../../dbconfig.php';

$id = $_POST['foodID'];
$foodPrice = $_POST['foodPrice'];
$ingreArray = $_POST['ingre'];
array_pop($ingreArray);
$ingre = implode("|", $ingreArray);

try {
    $stmt = $connect->prepare("UPDATE foods SET price = $foodPrice, ingredients = '$ingre' WHERE food_id = $id");

    if ($stmt->execute()) {
        echo "Successfully updated!";
    } else {
        echo "Query Problem";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}