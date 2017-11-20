<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thai Food Delivery</title>
    <link rel="stylesheet" type="text/css" href="vendor/css/food.css">
</head>
<body>
<?php require_once('menu.php'); ?>
<link rel="stylesheet" type="text/css" href="vendor/css/dataTables.bootstrap.min.css">
<script src="vendor/js/jquery.dataTables.min.js"></script>
<script src="vendor/js/dataTables.bootstrap.min.js"></script>

<div class="container" style="padding-bottom: 30px">
    <div class="table-responsive">
        <table class="table table-hover" id="deliveryTable">
            <thead>
            <tr>
                <th>Order date</th>
                <th>Food name</th>
                <th>Quantity</th>
                <th>Address</th>
                <th>Delivery status</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $cu_id = $_SESSION["cu_id"];
            $query = "SELECT order_id, orderDate, c.name as cu_name, f.name as f_name, quantity, address, isDelivered
                          FROM orders o join customer c on c.cu_id = o.cu_id
                          join foods f on f.food_id = o.food_id
                          where c.cu_id = $cu_id";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result) > 0):
                ?>
                <input type="hidden" value="<?= $row['order_id'] ?>">
                <?php
                while ($row = mysqli_fetch_array($result)):
                    if ($row['isDelivered'] == 1)
                        $isDelivered = true;
                    else
                        $isDelivered = false;
                    ?>
                    <tr>
                        <td><?= $row['orderDate'] ?></td>
                        <td><?= $row['f_name'] ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td>
                            <?php
                            if ($isDelivered)
                                echo '<b><p style="color:green;">Delivered</p></b>';
                            else
                                echo '<b><p style="color:red;">In progress</p></b>';
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once('footer.php') ?>
</body>
</html>

<script>
    $(document).ready(function () {
        $('#deliveryTable').DataTable();
    });
</script>