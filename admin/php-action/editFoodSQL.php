<?php
include_once '../../dbconfig.php';

$id = $_POST['foodID'];
$catID = $_POST['category'];
$foodPrice = $_POST['foodPrice'];
$stock = 0;
if (isset($_POST['stock']))
    $stock = $_POST['stock'];
$ingreArray = $_POST['ingre'];
array_pop($ingreArray);
$ingre = implode("|", $ingreArray);

try {
    $stmt = $connect->prepare("UPDATE foods SET category_id = $catID, price = $foodPrice, in_stock = $stock, ingredients = '$ingre' WHERE food_id = $id");

    if ($stmt->execute()) {
        echo "Successfully updated!";
    } else {
        echo "Query Problem";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}