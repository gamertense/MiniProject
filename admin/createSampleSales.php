<?php
require_once('../dbconfig.php');

for ($i = 1; $i <= 10; $i++) {
    if ($i <= 9)
        $m = '0' . $i;
    else
        $m = $i;

    $date = '2017-' . $m . '-22';

    $r_times = rand(1, 5);
    for ($j = 1; $j <= $r_times; $j++) {
        $r_cu = rand(1, 3);
        $fid = getFid($connect);
        $r_qty = rand(1, 3);
        $sql = "INSERT INTO orders (cu_id, food_id, orderDate, quantity) VALUES ('$r_cu', $fid, '$date', '$r_qty')";

        if ($connect->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
}

function getFid($connect)
{
    $fid = rand(2, 18);
    $sql = "SELECT food_id FROM foods WHERE food_id = $fid";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        return $fid;
    } else {
        getFid($connect);
    }
}